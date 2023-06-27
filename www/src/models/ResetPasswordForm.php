<?php

namespace App\models;

use App\core\Application as CoreApplication;
use App\core\exception\NotFoundException;
use App\core\Model as CoreModel;


class ResetPasswordForm extends CoreModel
{
    protected string $password = '';
    protected string $confirmPassword = '';

    public function rules(): array
    {
        return [
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function labels(): array
    {
        return [
            'password' => 'Password',
            'confirmPassword' => 'Confirm password',
        ];
    }

    public function getUserByToken()
    {
        $queryParams = CoreApplication::$app->request->getQueryParams();
        $resetToken = $queryParams['reset'] ?? null;

        if($resetToken !== null){
            $user = User::getOneBy('reset_token', $resetToken);
            return $user;
        }
    }

    public function isTokenValid()
    {
        $user = $this->getUserByToken();
        if($user){
            if($user->getResetTokenUsed() === true){
                return false;
            }
            return true;
        }
    }

    public function updateUserPassword()
    {
        $user = $this->getUserByToken();
        if($user){
            $user->setPassword($this->getPassword());
            $user->updateOne('password', $user->getPassword());
            $user->updateOne('reset_token_used', true);
            return true;
        }
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return string
     */
    public function getConfirmPassword(): string
    {
        return $this->password;
    }
}