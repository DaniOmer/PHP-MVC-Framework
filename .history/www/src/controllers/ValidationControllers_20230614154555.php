<?php

namespace App\controllers;
use App\models\Validation_token;


class ValidationControllers{


    public function create($data, $id){
        $Valida = new Valida();
        $Valida->setId($id);
        $Valida->setUserid($id);
        $Valida->setToken($data->token);
        $Valida->setCreatedat($data->created_at);
        
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