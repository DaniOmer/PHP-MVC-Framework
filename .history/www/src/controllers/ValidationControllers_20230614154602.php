<?php

namespace App\controllers;
use App\models\Validation_token;


class Validation{


    public function create($data, $id){
        $Validation = new Validation();
        $Validation->setId($id);
        $Validation->setUserid($id);
        $Validation->setToken($data->token);
        $Validation->setCreatedat($data->created_at);
        
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