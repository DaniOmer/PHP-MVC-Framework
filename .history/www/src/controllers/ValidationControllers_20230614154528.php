<?php

namespace App\controllers;
use App\models\Validation_token;


class ValidationControllers{


    public function create($data, $id){
        $reset_password = new Reset_password();
        $reset_password->setId($id);
        $reset_password->setUserid($id);
        $reset_password->setToken($data->token);
        $reset_password->setCreatedat($data->created_at);
        
    }

    public function read(string $id){
        $reset_password = new Reset_password();
        $reset_password->setId($id);
    }

    public function update($data){
        $reset_password = new Reset_password();
        $reset_password->settoken($data->token);
    }

    public function delete(string $id){
        $reset_password = new Reset_password();
        $reset_password->setId($id);
    }

}