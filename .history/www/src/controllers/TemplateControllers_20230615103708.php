<?php

namespace App\controllers;
use App\models\Template;

class TemplateController{

    public function create($data, $id){
        $template = new Template();
        $template-> setId(-1);
        $template->settemplate($data->template);
        $template->setAbilities($data->abilities);
        $template->setCreatedat($data->created_at);
        $template->setUpdatedat($data->updated_at);
        
    }

    public function read(string $id){
        $token = new Token();
        $token->setId($id);
    }

    public function update($data){
        $token = new Token();
        $token->setToken($data->Token);
    }

    public function delete(string $id){
        $token = new Token();
        $token->setId($id);
    }
}
]