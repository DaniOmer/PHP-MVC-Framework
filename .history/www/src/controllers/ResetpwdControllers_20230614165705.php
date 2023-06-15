<?php
namespace App\controllers;
use App\models\Reset_password;

class Reset_PasswordController{


    public function create($data, $id){
        $reset_password = new Reset_password();
        $reset_password->setId($-1);
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