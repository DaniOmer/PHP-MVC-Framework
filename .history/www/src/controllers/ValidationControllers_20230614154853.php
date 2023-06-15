<?php

namespace App\controllers;
use App\models\Validation_token;


class Validation_tokens{


    public function create($data, $id){
        $validation = new $Validation_tokens();
        $validation->setId($id);
        $validation->setUserid($id);
        $validation->setToken($data->token);
        $validation->setCreatedat($data->created_at);
        
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