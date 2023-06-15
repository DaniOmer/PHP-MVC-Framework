<?php
namespace App\controllers;
use App\models\token;

class TokenController{


    public function create($data){
        $Token = new token();
        $Token->settoken($data->tokenname);
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