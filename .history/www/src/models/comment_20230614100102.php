<?php

namespace App\models;


class Comment {
    private int $id;
    private int $user_id; 
    private int $page_id;
    private string $comment;
    private string $is_moderated;
    private string $created_at;
    private string $updated_at;

}