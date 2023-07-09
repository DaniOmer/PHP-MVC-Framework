<?php

namespace App\models;

use App\core\Application as CoreApplication;
use App\core\Model as CoreModel;


class LoginForm extends CoreModel
{
    protected string $email = '';
    protected string $password = '';
    protected ?string $token = null;

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }
 
    public function labels(): array
    {
        return [
            'email' => 'Your Email address',
            'password' => 'Password'
        ];
    }

    public function login()
    {
        $user = User::getOneBy('email', $this->getEmail());
        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        if (!password_verify($this->getPassword(), $user->getPassword())) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        if($user->getVerifyTokenUsed() === false || $user->getVerifyTokenUsed() === null){
            CoreApplication::$app->session->setFlash('alerte', 'Please verify your account and try again !');
            return false;
        }
        $this->token = CoreApplication::$app->generateUserToken($user);
        return CoreApplication::$app->login($user);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email ?? '';
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password ?? '';
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}