<?php
namespace App\controllers;
use App\models\token;

class TokenController{


    public function create($data){
        $Token = new token();
        $Token->setname($data->name);
    }

    public function read(string $id){
        $token = new Token();
        $token->setId($id);
    }

    public function update($data){
        $token = new Token();
        $token->setUsername($data->username);
    }

    public function delete(string $id){
        $token = new Token();
        $user->setId($id);
    }

}