<?php
namespace App\controllers;
use App\models\User;

class UserController{


    public function create($data){
        $user = new User();
        $user->setUsername($data->username);
    }

    public function update($data){
        $user = new User();
        $user->setUsername($data->username);
    }

    public function delete(public function create($data){
        $user = new User();
        $user->setUsername($data->username);
    }$id){
        $user = new User();
        $user->setUsername($data->username);
    }

}