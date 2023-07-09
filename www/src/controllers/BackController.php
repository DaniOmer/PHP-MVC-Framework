<?php

namespace App\controllers;

use App\core\Application;
use App\core\exception\NotFoundException;
use App\core\middlewares\AccountMiddleware;
use App\core\middlewares\AuthMiddleware;
use App\core\Request;
use App\models\ContactForm;

/**
 * class Front
 * 
 * @package App\controllers
 */
class BackController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['dashboard', 'profile', 'users', 'page', 'comment', 'chart']));
    }


    public function profile()
    {
        $this->setLayout('back');
        return $this->render('profile');
    }

    public function users()
    {
        $this->setLayout('back');
        return $this->render('users');
    }

    public function page()
    {
        $this->setLayout('back');
        return $this->render('page');
    }

    public function comment()
    {
        $this->setLayout('back');
        return $this->render('comment');
    }
    
    public function chart()
    {
        $this->setLayout('back');
        return $this->render('chart');
    }
}
