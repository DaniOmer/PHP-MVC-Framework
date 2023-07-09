<?php

namespace App\models;

use App\core\Application as CoreApplication;
use App\core\Model as CoreModel;
use App\core\SendMail;

class RecoverPasswordForm extends CoreModel
{
    protected string $email = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your Email address',
        ];
    }

    public function sendResetMail()
    {
        $user = User::getOneBy('email', $this->getEmail());

        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }

        if($user->getVerifyTokenUsed() === false){
            CoreApplication::$app->session->setFlash('alerte', 'Please verify your account and try again !');
            return false;
        }

        $mail = [];
        $mail['url'] = CoreApplication::$app->baseUrl.'/reset-password?reset=';
        $mail['email'] = $user->getEmail();
        $mail['token'] = bin2hex(random_bytes(32));
        $mail['bodyText'] = 'Click on the link to reset your password : ';
        $user->updateOne('reset_token', $mail['token']);
        $user->updateOne('reset_token_used', false);

        $sendMail = new SendMail($mail);
        $sendMail->send();

        return true;
    }

    public function getEmail(): string
    {
        return $this->email ?? '';
    }
}