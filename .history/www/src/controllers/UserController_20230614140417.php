<?php
namespace App\controllers;
use App\models\User;

class UserController{


    public function create($data){
        $user = new User();
        $user->setUsername($data->username);
    }

    public function create($data){
        $user = new User();
        $user->setUsername($data->username);
    }

}