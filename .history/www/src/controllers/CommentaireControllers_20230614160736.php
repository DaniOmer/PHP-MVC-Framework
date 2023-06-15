<?php

namespace App\controllers;
use App\models\Comment;

class Validation_tokenControllers{
    public function create($data, $id){
        $comment = new Comment(); 
        $comment->setId($id); // Correction du nom de la variable
        $comment->setUserid($id); // Correction du nom de la variable
        $comment->setUserid($id);
        $comment->setCreatedat($data->created_at);
    }

    public function read(string $id){
        $validation_token = new Validation_token(); 
        $validation_token->setId($id); // Correction du nom de la variable
    }

    public function update($data){
        $validation_token = new Validation_token(); 
        $validation_token->setToken($data->token); // Correction du nom de la méthode
    }

    public function delete(string $id){
        $validation_token = new Validation_token(); 
        $validation_token->setId($id); // Correction du nom de la variable
    }
}
