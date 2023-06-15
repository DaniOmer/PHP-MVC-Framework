<?php

namespace App\controllers;
use App\models\Theme;

class ThemeControllers {
    public function create($data, $id){
        $theme = new Theme(); 
        $theme->setId($id); 
        $theme->setName($date -> name)
    }

    public function read(string $id){
        $theme = new Theme(); 
        $theme->setId($id); 
    }

    public function update($id){
        $theme = new Theme(); 
        $theme->setId($id);
    }

    public function delete(string $id){
        $theme = new Theme(); 
        $theme->setId($id);
    }
}
