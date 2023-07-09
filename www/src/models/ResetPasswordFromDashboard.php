<?php

namespace App\models;

use App\core\Application as CoreApplication;
use App\core\exception\NotFoundException;
use App\core\Model as CoreModel;


class ResetPasswordFromDashboard extends CoreModel
{
    protected string $currentPassword = '';
    protected string $password = '';
    protected string $confirmPassword = '';

    public function rules(): array
    {
        return [
            'currentPassword' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }
 
    public function labels(): array
    {
        return [
            'currentPassword' => ' Current password',
            'password' => 'New password',
            'confirmPassword' => 'Confirm new password',
        ];
    }


    public function updateUserPassword()
    {
        $user = CoreApplication::$app->user;
        if($user){
            if(!password_verify($this->getCurrentPassword(), $user->getPassword())){
                $this->addError('currentPassword', 'Current password is incorrect !');
                return false;
            }
            $user->setPassword($this->getPassword());
            $user->updateOne('password', $user->getPassword());
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

    /**
     * @param string $currentPassword
     */
    public function setCurrentPassword(string $currentPassword): void
    {
        $this->password = password_hash($currentPassword, PASSWORD_DEFAULT);
    }

    /**
     * @return string
     */
    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }
}