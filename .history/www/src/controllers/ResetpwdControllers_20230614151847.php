<?php
namespace App\controllers;
use App\models\Reset_password;

class Reset_PasswordController{


    public function create($id){
        $reset_password = new Reset_password();
        $reset_password->setId($id);
        $reset_password->setId($id);
        
    }

    public function read(string $id){
        $reset_password = new reset_password();
        $reset_password->setId($id);
    }

    public function update($data){
        $user = new User();
        $user->setUsername($data->username);
    }

    public function delete(string $id){
        $user = new User();
        $user->setId($id);
    }

}