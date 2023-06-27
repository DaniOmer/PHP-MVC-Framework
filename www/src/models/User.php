<?php
namespace App\models;

use App\core\Application;
use App\core\ORM;
use App\core\UserModel;

class User extends UserModel
{

    public $id = -1;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $confirmPassword;
    protected $date_inserted;
    protected $date_updated;
    protected $verify_token;
    protected $verify_token_used;
    protected $reset_token;
    protected $reset_token_used;


    public function __construct()
    {
        $this->verify_token = bin2hex(random_bytes(32));
        parent::__construct();
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_NAME, 'name' => 'firstname']],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_NAME, 'name' => 'lastname']],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }


    public function saveData (){
        $this->setFirstname($this->getFirstname());
        $this->setLastname($this->getLastname());
        $this->setEmail($this->getEmail());
        $this->setPassword($this->getPassword());
        
        


        if ($this->isNewRecord()) {
            // C'est un nouvel enregistrement, mettez à jour les propriétés date_inserted et date_updated
            $currentTimestamp = time();
            $this->date_inserted = date('Y-m-d H:i:s', $currentTimestamp);
            $this->date_updated = date('Y-m-d H:i:s', $currentTimestamp);
            
        } else {
            // Ce n'est pas un nouvel enregistrement, mettez uniquement à jour la propriété date_updated
            $this->date_updated = date('Y-m-d H:i:s', time());
        }

        return parent::save();
    }


    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Your Email address',
            'password' => 'Password',
            'confirmPassword' => 'Confirm password',
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname.' '.$this->lastname;
    }


    public function __toString(): string
    {
        return serialize($this);
    }

    public function isNewRecord()
    {
        return $this->isNewRecord;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
        $this->isNewRecord = ($id <= 0);
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

    /**
     * @return string
     */
    public function getConfirmPassword(): string
    {
        return $this->confirmPassword ?? '';
    }

    /**
     * @return string $token
     */
    public function getVerifyToken(): string
    {
        return $this->verify_token ?? '';
    }

    /**
     * @return string $token
     */
    public function getResetToken(): bool
    {
        return $this->reset_token ?? '';
    }

     /**
     * @return void $state
     */
    public function setVerifyTokenUsed(bool $state): void
    {
        $this->verify_token_used = $state;
    }

     /**
     * @return bool
     */
    public function getVerifyTokenUsed(): bool
    {
        return $this->verify_token_used ?? false;
    }

    /**
     * @param string $status
     */
    public function setResetTokenUsed(bool $state): void
    {
        $this->reset_token_used = $state;
    }

     /**
     * @return bool
     */
    public function getResetTokenUsed(): bool
    {
        return $this->reset_token_used ?? false;
    }


}

