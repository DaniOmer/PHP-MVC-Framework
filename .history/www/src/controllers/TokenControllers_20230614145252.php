<?php
namespace App\controllers;
use App\models\token;

class TokenController{


    public function create($data){
        $Token = new token();
        $Token->setToken($data->token);
        $Token->setAbilities($data->created_at);
        $Token->setCreatedat($data->created_at);
        $Token->setUpdatedat($data->updated_at);
        $Token->setExpireat($data->expire_at);
    }

    public function read(string $id){
        $token = new Token();
        $token->setId($id);
    }

    public function update($data){
        $token = new Token();
        $token->setToken($data->username);
    }

    public function delete(string $id){
        $token = new Token();
        $token->setId($id);
    }

}