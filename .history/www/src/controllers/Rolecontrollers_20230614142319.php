<?php
namespace App\controllers;
use App\models\Role;

class UserController{


    public function create($data){
        $role = new Role();
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
        $comment = new Comment();
        $user->setId($id);
    }

}