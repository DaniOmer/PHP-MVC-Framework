<?php

namespace App\controllers;
use App\models\Validation_token;


class Validation_tokenontrollers{


    public function create($data, $id){
        $_tokens = new $Validation_token();
        $_tokens->setId($id);
        $_tokens->setUserid($id);
        $_tokens->setToken($data->token);
        $_tokens->setCreatedat($data->created_at);
        
    }

    public function read(string $id){
        $validation = new validation();
        $validation->setId($id);
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