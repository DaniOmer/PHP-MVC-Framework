<?php

namespace App\controllers;
use App\models\Validation_token;


class Validation_tokenControllers{


    public function create($data, $id){
        $_tokens = new $Validation_tokens();
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
        $validation = new Validation_tokenq();
        $validation->settoken($data->token);
    }

    public function delete(string $id){
        $validation = new Reset_password();
        $validation->setId($id);
    }

}