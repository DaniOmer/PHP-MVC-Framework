<?php

namespace App\controllers;
use App\models\Template;

class TemplateController{

    public function create($data, $id){
        $template = new Template();
        $template-> setId(-1);
        $template-> setPageid
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
        $template->setFilepath($data->file_path);
    }

    public function delete(string $id){
        $template = new Template();
        $template->setId($id);
    }

}
