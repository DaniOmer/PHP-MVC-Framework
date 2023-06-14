<?php

namespace App\models;


class User {

    private int $id ;
    private int $role_id;
    private string $username;
    private string $email;
    private string $email_verified_at;
    private string $password;
    private string $created_at;
    private string $updated_at;


    public function getId(): int
    {
        return $this->id;
    }

    public function settId(int $id) : void
    {
       $this->id = $id;
    }

     public function getUsername(): string 
     {
                
     }

}





