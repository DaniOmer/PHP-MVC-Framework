<?php
namespace App\controllers;
use App\models\Role;

class RoleController{


    public function create($data){
        $role = new Role();
        $role->setname($data->name);
        $role->setdes($data->name);
        $role->setname($data->name);
        $role->setname($data->name);

    }

    public function read(string $id){
        $role = new Role();
        $role->setId($id);
    }

    public function update($data){
        $role = new Role();
        $role->setId($data->id);
        $role->setname($data->name);
    }

    public function delete(string $id){
        $role = new Role();
        $role->setId($id);
    }

}