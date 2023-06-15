<?php
namespace App\controllers;
use App\models\Reset_password;

class Reset_PasswordController{


    public function create($data, $id){
        $reset_password = new Reset_password();
        $reset_password->setId($id);
        $reset_password->setToken($data->token);
        
    }

    public function read(string $id){
        $reset_password = new Reset_password();
        $reset_password->setId($id);
    }

    public function update($data){
        $reset_password = new Reset_password();
        $reset_password->setCreatedat($data->createdat);
    }

    public function delete(string $id){
        $reset_password = new Reset_password();
        $reset_password->setId($id);
    }

}