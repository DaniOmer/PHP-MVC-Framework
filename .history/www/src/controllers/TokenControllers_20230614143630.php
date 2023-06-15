<?php
namespace App\controllers;
use App\models\Token;

class TokenController{


    public function create($data){
        $Token = new Token();
        $Token->setname($data->name);
    }

    public function read(string $id){
        $user = new User();
        $user->setId($id);
    }

    public function update($data){
        $user = new User();
        $user->setUsername($data->username);
    }

    public function delete(string $id){
        $user = new User();
        $user->setId($id);
    }

}