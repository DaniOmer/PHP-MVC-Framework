<?php 

namespace App\controllers;

use App\models\Validation_token;

class Validation_tokenControllers{

    public function create($data, $id){
        $validation_token = new Validation_token(); 
        $validation_token->setId($id);
        $validation_token->setUserid($id);
        $validation_token->setToken($data->token);
        $validation_token->setCreatedat($data->created_at);
    }

    public function read(string $id){
        $validation_token = new Validation_token(); 
        $validation_token->setId($id);
    }

    public function update($data){
        $validation_token = new Validation_token(); 
        $validation_token->setToken($data->token); 
    }

    public function delete(string $id){
        $validation_token = new Validation_token(); 
        $validation_token->setId($id);
    }
}
