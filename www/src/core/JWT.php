<?php

namespace App\core;

class JWT
{
    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function generate(array $header, array $payload, int $validity = 86400): string
    {
        if ($validity > 0) {
            $now = new \DateTime();
            $expiration = $now->getTimestamp() + $validity;
            $payload['iat'] = $now->getTimestamp();
            $payload['exp'] = $expiration;
        }

        $base64Header = $this->base64UrlEncode(json_encode($header));
        $base64Payload = $this->base64UrlEncode(json_encode($payload));

        $signature = $this->generateSignature($base64Header, $base64Payload);

        $jwt = $base64Header . '.' . $base64Payload . '.' . $signature;

        return $jwt;
    }

    public function check(string $token): bool
    {
        // On récupère le header et le payload
        $header = $this->getHeader($token);
        $payload = $this->getPayload($token);

        // On vérifie les revendications
        if (!$this->verifyClaims($payload)) {
            return false;
        }
 
        // On génère un token de vérification
        $verifToken = $this->generate($header, $payload, 0);

        return $token === $verifToken;
    }

    public function getHeader(string $token)
    {
        $array = explode('.', $token);
        $header = json_decode($this->base64UrlDecode($array[0]), true);
        return $header;
    }

    public function getPayload(string $token)
    {
        $array = explode('.', $token);
        $payload = json_decode($this->base64UrlDecode($array[1]), true);
        return $payload;
    }

    // ... autres méthodes ...

    private function generateSignature(string $base64Header, string $base64Payload): string
    {
        $signature = hash_hmac('sha512', $base64Header . '.' . $base64Payload, $this->secret, true);
        return $this->base64UrlEncode($signature);
    }

    private function base64UrlEncode(string $data): string
    {
        $base64 = base64_encode($data);
        return str_replace(['+', '/', '='], ['-', '_', ''], $base64);
    }

    private function base64UrlDecode(string $data): string
    {
        $base64 = str_replace(['-', '_'], ['+', '/'], $data);
        return base64_decode($base64, true);
    }

    private function verifyClaims(array $payload): bool
    {
        $now = new \DateTime();
        $currentTimestamp = $now->getTimestamp();

        if (isset($payload['exp']) && $payload['exp'] <= $currentTimestamp) {
            return false; // Le token a expiré
        }

        if (isset($payload['nbf']) && $payload['nbf'] > $currentTimestamp) {
            return false; // Le token n'est pas encore valide
        }

        return true; // Toutes les revendications sont valides
    }
}
