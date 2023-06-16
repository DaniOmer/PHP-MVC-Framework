<?php

namespace App\controllers;

use App\core\Application;

/**
 * class Front
 * 
 * @package App\controllers
 */
class FrontController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "Omer"
        ];
        return $this->render('home', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function about()
    {
        return $this->render('about');
    }

    public function faq()
    {
        return $this->render('faq');
    }
    
}
