<?php

namespace App\controllers;

use App\controllers\Controller;
use App\core\Application;
use App\core\exception\NotFoundException;
use App\core\middlewares\AuthMiddleware;
use App\core\Request;
use App\core\Response;
use App\core\SendMail;
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
                $sendMail = new SendMail($userModel->getEmail(), $userModel->getVerificationCode());
                $sendMail->send();

                Application::$app->response->redirect('/');
                Application::$app->session->setFlash(
                    'success', 'Thanks for registering '.$userModel->getLastname().' ! We\'ve send a verification link on your email address.'
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

    public function verify(Request $request)
    {
        $queryParams = $request->getQueryParams();
        $verificationCode = $queryParams['verification'] ?? null;

        // Vérifiez si le code de vérification est valide
        if ($verificationCode !== null) {
            $user = User::getOneBy('code', $verificationCode);
            if ($user) {
                $user->setStatus('verified');
                $status = $user->getStatus();
                $user->updateOne('status', $status);
                return $this->render('verify');
            }
        }
        Throw new NotFoundException();
    }

}