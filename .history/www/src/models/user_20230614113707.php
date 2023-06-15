<?php

namespace App\models;


class User extends ORM{

    private int $id ;
    private int $role_id;
    private string $username;
    private string $email;
    private string $email_verified_at;
    private string $password;
    private string $created_at;
    private string $updated_at;


    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of role_id
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * Set the value of role_id
     */
    public function setRoleId(int $role_id): self
    {
        $this->role_id = $role_id;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of email_verified_at
     */
    public function getEmailVerifiedAt(): string
    {
        return $this->email_verified_at;
    }

    /**
     * Set the value of email_verified_at
     */
    public function setEmailVerifiedAt(string $email_verified_at): self
    {
        $this->email_verified_at = $email_verified_at;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt(string $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /*CRUD*/

    function getAllUsers {

    }

    function getUser{

    }

    function 
}





