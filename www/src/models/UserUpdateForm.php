<?php


namespace App\models;

use App\core\Application;
use App\core\Model;
 
class UserUpdateForm extends Model
{
    protected string $firstname = '';
    protected string $lastname = '';
    protected string $email = '';
    protected string $role = '';

    public function rules(): array
    {
        $currentUser = Application::$app->user;
        $isAdmin = $currentUser->getAdminId() === -1 ? true : false;
        $user = User::getOneBy('email', $this->getEmail());
        $userAdminId = $user ? $user->getAdminId() : null;

        $uniqueRule = (!$isAdmin && $this->getEmail() !== $currentUser->getEmail()) || ($isAdmin && $userAdminId !== $currentUser->getId()) ? [self::RULE_USER_UNIQUE, 'class' => self::class] : '';

        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_NAME, 'name' => 'firstname']],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_NAME, 'name' => 'lastname']],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, $uniqueRule],
        ];

    }

    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email address',
            'role' => 'User role',
        ];
    }

    public function updateUserInformations($userId)
    {
        $user = User::getOneBy('id', $userId);

        if($user){
            $user->setFirstname($this->getFirstname());
            $user->setLastname($this->getLastname());
            $user->setEmail($this->getEmail());
            if($this->getRole() !== ''){
                $user->setRole($this->getRole());
            }
            $user->saveData();
            return true;
        }
    }

    public static function getTable(): string
    {
        return "esgi_user";
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname ?? '';
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname ?? '';
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
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
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->firstname = strtolower(trim($role));
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role ?? '';
    }
}