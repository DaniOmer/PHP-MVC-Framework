<?php
namespace App\controllers;
use App\models\token;

class TokenController{


    public function create($data){
        $Token = new token();
        $Token->setCoken($data->token);
        $Token->setCreated_at($data->created_at);
        $Token->settoken($data->token);
        $Token->settoken($data->token);
    }

    public function read(string $id){
        $token = new Token();
        $token->setId($id);
    }

    public function update($data){
        $token = new Token();
        $token->setname($data->username);
    }

    public function delete(string $id){
        $token = new Token();
        $token->setId($id);
    }

}