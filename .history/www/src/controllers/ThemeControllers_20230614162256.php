<?php

namespace App\controllers;
use App\models\Theme;

class ThemeControllers {
    public function create($data, $id){
        $Theme = new Theme(); 
        $Theme->setId($id); 
        $Theme->setUserid($id);
        $Theme->setPageid($id);
        $Theme->setIsmoderated($data-> is_moderated);
        $Theme->setCreatedat($data->created_at);
        $Theme->setUpdatedat($data->updated_at);
    }

    public function read(string $id){
        $Theme = new Theme(); 
        $Theme->setId($id); 
    }

    public function update($id){
        $Theme = new Theme(); 
        $Theme->setId($id);
    }

    public function delete(string $id){
        $Theme = new Theme(); 
        $Theme->setId($id);
    }
}
