<?php

namespace App\controllers;
use App\models\Comment;

class CommentControllers {
    public function create($data, $id){
        $comment = new Comment(); 
        $comment->setId($id); 
        $comment->setUserid($id); 
        $comment->setUserid($id);
        $comment->setPageid($id);
        $comment->setCreatedat($data->created_at);
        $comment->setUpdatedat($data->updated_at);
    }


    public function read(string $id){
        $comment = new Comment(); 
        $comment->setId($id); 
    }

    public function update($id){
        $comment = new Comment(); 
        $comment->setId($id);
    }

    public function delete(string $id){
        $comment = new Comment(); 
        $comment->setId($id);
    }
}
