<?php

namespace App\controllers;

use App\controllers\Controller;
use App\core\Application;
use App\core\middlewares\AuthMiddleware;
use App\core\Request;
use App\core\Response;
use App\models\LoginForm;
use App\models\User;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }


    public function login(Request $request, Response $response)
    {

        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){  
                Application::$app->response->redirect('/');
                Application::$app->session->setFlash('success', 'Welcome back '.Application::$app->user->getDisplayName().' !');
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
                Application::$app->session->setFlash(
                    'success', 'Thanks for registering '.$userModel->getLastname().' ! Please check your mail to verify your email adress.'
                );
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

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        $this->setLayout('back');
        return $this->render('profile');
    }
}