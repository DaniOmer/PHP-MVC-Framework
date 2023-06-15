<?php

namespace App\controllers;
use App\models\Validation_token;
use App\models\Validation_tokens;

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
        $validation = new Validation_tokens();
        $validation->settoken($data->token);
    }

    public function delete(string $id){
        $validation = new Validation_tokensC();
        $validation->setId($id);
    }

}