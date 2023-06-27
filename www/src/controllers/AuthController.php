<?php

namespace App\controllers;

use App\controllers\Controller;
use App\core\Application;
use App\core\exception\NotFoundException;
use App\core\middlewares\AccountMiddleware;
use App\core\middlewares\AuthMiddleware;
use App\core\Request;
use App\core\Response;
use App\core\SendMail;
use App\models\LoginForm;
use App\models\RecoverPasswordForm;
use App\models\ResetPasswordForm;
use App\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['dashboard']));
        $this->registerMiddleware(new AccountMiddleware(['register', 'login', 'recover', 'reset']));
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
            $mail = [];
            $mail['url'] = Application::$app->baseUrl.'/verify?verification=';
            $mail['email'] = $userModel->getEmail();
            $mail['token'] = $userModel->getVerifyToken();
            $mail['bodyText'] = 'Here is the verification link : ';

            if($userModel->validate() && $userModel->saveData()){
                $sendMail = new SendMail($mail);
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

    public function dashboard()
    {
        $this->setLayout('back');
        return $this->render('dashboard');
    }

    public function verify(Request $request)
    {
        $queryParams = $request->getQueryParams();
        $verificationToken = $queryParams['verification'] ?? null;

        // Vérifiez si le token de vérification est valide
        if ($verificationToken !== null) {
            $user = User::getOneBy('verify_token', $verificationToken);
            if ($user) {

                if ($user->getVerifyTokenUsed() === true) {
                    Application::$app->response->redirect('/');
                    Application::$app->session->setFlash('alerte', 'The verification link has expired !');
                }else{
                    $user->updateOne('verify_token_used', true);
                    Application::$app->response->redirect('/');
                    Application::$app->session->setFlash('success', 'Your e-mail address has been verified !');
                }

                return $this->render('verify');
            }else{
                Application::$app->response->redirect('/');
                Application::$app->session->setFlash('success', 'The page you ask for does not exist !');
            }
        }
        Throw new NotFoundException();
    }

    public function recover(Request $request)
    {
        $recoverPasswordForm = new RecoverPasswordForm();
        
        if($request->isPost()){
            $recoverPasswordForm->loadData($request->getBody());
            if($recoverPasswordForm->validate() && $recoverPasswordForm->sendResetMail()){  
                Application::$app->response->redirect('/');
                Application::$app->session->setFlash('success', 'We\'ve sent you an email !');
            }
        }
        $this->setLayout('auth');
        return $this->render('recover-password', [
            'model' => $recoverPasswordForm
        ]);
    }

    public function reset(Request $request)
    {
        $resetPasswordForm = new ResetPasswordForm();
        if($resetPasswordForm->isTokenValid()){
            if($request->isPost()){
                $resetPasswordForm->loadData($request->getBody());
                if($resetPasswordForm->validate() && $resetPasswordForm->updateUserPassword()){  
                    Application::$app->response->redirect('/');
                    Application::$app->session->setFlash('success', 'Your password has been updated successfully');
                }
            }
            $this->setLayout('auth');
            return $this->render('reset-password', [
                'model' => $resetPasswordForm
            ]);
        }
        Application::$app->response->redirect('/');
        Application::$app->session->setFlash('alerte', 'The reset link has expired !');
    }

}