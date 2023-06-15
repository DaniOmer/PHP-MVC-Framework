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
        $comment = new Comment ();
        $user->setUsername($data->username);
    }

    public function delete(string $id){
        $comment = new Role();
        $user->setId($id);
    }

}