<?php

namespace App\controllers;
use App\models\Comment;

class Validation_tokenControllers{
    public function create($data, $id){
        $comment = new Comment(); // Correction du nom de la classe
        $comment->setId($id); // Correction du nom de la variable
        $comment->setUserid($id); // Correction du nom de la variable
        $comment->setUserid($data -> Username);
        $comment->setCreatedat($data->created_at);
    }

    public function read(string $id){
        $validation_token = new Validation_token(); // Correction du nom de la classe
        $validation_token->setId($id); // Correction du nom de la variable
    }

    public function update($data){
        $validation_token = new Validation_token(); // Correction du nom de la classe
        $validation_token->setToken($data->token); // Correction du nom de la méthode
    }

    public function delete(string $id){
        $validation_token = new Validation_token(); // Correction du nom de la classe
        $validation_token->setId($id); // Correction du nom de la variable
    }
}
