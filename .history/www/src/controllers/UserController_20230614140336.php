<?php
namespace App\controllers;
use App\models\User;

class UserController{


    public function store($data){
        $user = new User();
        $user->setUsername($data->username);

        
    }
}