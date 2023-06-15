<?php
namespace App\controllers;
use App\models\User;

class UserController{


    public function create($data){
        $user = new User();
        $user->setUsername($data->username);
        $user->setId(-1);
        $user->setEmail($data-> email);
        $user->setPassword($data -> password);
        $user->setemembertoken($data -> remember_token);
        $user->setCreatedat($data -> create_at);
        $user->setUpdatedat($data -> updated_at);

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