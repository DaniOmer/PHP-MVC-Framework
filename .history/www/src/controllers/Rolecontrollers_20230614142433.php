<?php
namespace App\controllers;
use App\models\Role;

class RoleController{


    public function create($data){
        $role = new Role();
        $role->setUsername($data->username);
    }

    public function read(string $id){
        $role = new Role();
        $user->setId($id);
    }

    public function update($data){
        $role = new Role();
        $user->setUsername($data->username);
    }

    public function delete(string $id){
        $role = new Role();
        $user->setId($id);
    }

}