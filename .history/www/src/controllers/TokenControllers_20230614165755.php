<?php
namespace App\controllers;
use App\models\token;

class TokenController{


    public function create($data){
        $token = new Token();
        $token-> setId(-1);
        $token->settoken($data->token);
        $token->setAbilities($data->abilities);
        $token->setCreatedat($data->created_at);
        $token->setUpdatedat($data->updated_at);
        $token->setExpireat($data->expire_at);
    }

    public function read(string $id){
        $token = new Token();
        $token->setId($id);
    }

    public function update($data){
        $token = new Token();
        $token->setToken($data->Token);
    }

    public function delete(string $id){
        $token = new Token();
        $token->setId($id);
    }

}