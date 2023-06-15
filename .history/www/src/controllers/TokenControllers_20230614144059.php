<?php
namespace App\controllers;
use App\models\Personnel_access_tokens;

class TokenController{


    public function create($data){
        $Token = new token();
        $Token->setname($data->name);
    }

    public function read(string $id){
        $Token = new Token();
        $Token->setId($id);
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