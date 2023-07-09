<?php

namespace App\models;

use App\core\Application as CoreApplication;
use App\core\Model as CoreModel;


class LoginForm extends CoreModel
{
    public string $email = '';
    public string $password = '';

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
        $user = User::getOneBy('email', $this->email);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        if($user->getStatus() !== 'verified'){
            CoreApplication::$app->session->setFlash('alerte', 'Please verify your account and try again !');
            return false;
        }
        return CoreApplication::$app->login($user);
    }
}