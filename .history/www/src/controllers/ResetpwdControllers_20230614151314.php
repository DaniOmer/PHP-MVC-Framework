<?php
namespace App\controllers;
use App\models\Reset_password;

class Reset_PasswordController{


    public function create($data){
        $reset = new Reset_password();
        $user->setUsername($data->username);
    }

    public function read(string $id){
        $user = new User();
        $user->setId($id);
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