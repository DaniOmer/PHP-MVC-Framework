<?php

namespace App\controllers;
use App\models\Template;

class TemplateController{

    public function create($data, $id){
        $template = new Template();
        $template-> setId(-1);
        $template->setName($data->Name);
        $template->setFilepath($data->file_path);
        $template->setCreatedat($data->created_at);
        $template->setUpdatedat($data->updated_at);
        
    }

    public function read(string $id){
        $template = new Template();
        $template->setId($id);
    }

    public function update($data){
        $template = new Template();
        $template->setToken($data->Token);
    }

    public function delete(string $id){
        $token = new Token();
        $token->setId($id);
    }
}
]