<?php

namespace App\controllers;
use App\models\Theme;

class ThemeControllers {
    public function create($data, $id){
        $theme = new theme(); 
        $theme->setId($id); 
        $theme->setUserid($id);
        $theme->setPageid($id);
        $theme->setIsmoderated($data-> is_moderated);
        $theme->setCreatedat($data->created_at);
        $theme->setUpdatedat($data->updated_at);
    }

    public function read(string $id){
        $theme = new theme(); 
        $theme->setId($id); 
    }

    public function update($id){
        $theme = new theme(); 
        $theme->setId($id);
    }

    public function delete(string $id){
        $theme = new theme(); 
        $theme->setId($id);
    }
}
