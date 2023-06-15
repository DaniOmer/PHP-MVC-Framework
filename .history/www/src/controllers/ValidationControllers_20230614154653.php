<?php

namespace App\controllers;
use App\models\Validation_token;


class Validation{


    public function create($data, $id){
        $validation = new Validation();
        $validation->setId($id);
        $validation->setUserid($id);
        $validation->setToken($data->token);
        $validation->setCreatedat($data->created_at);
        
    }

    public function read(string $id){
        $va = new va();
        $va->setId($id);
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