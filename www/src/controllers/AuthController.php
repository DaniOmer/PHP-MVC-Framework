<?php

namespace App\controllers;

use App\controllers\Controller;
use App\core\Application;
use App\core\Request;
use App\core\Response;
use App\models\LoginForm;
use App\models\User;


class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                Application::$app->response->redirect('/');
                Application::$app->session->setFlash('success', 'Bienvenue !');
            }
        }
    
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {

        $userModel = new User;

        if ($request->isPost()){
            $userModel->loadData($request->getBody());

            if($userModel->validate() && $userModel->saveData()){
                Application::$app->response->redirect('/');
                Application::$app->session->setFlash('success', 'Thanks for registering !');
            }
            return $this->render('register', [
                "model" => $userModel
            ]);
        }
        
        $this->setLayout('auth');
        return $this->render('register', [
            "model" => $userModel
        ]);
    }
}