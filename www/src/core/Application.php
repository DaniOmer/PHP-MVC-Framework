<?php
/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/core/Application.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

namespace App\core;

use App\controllers\Controller;
use App\controllers\FrontController;
use App\core\exception\ForbiddenException;
use App\models\Page;
use App\models\User;

/**
 * class Application
 * 
 * @package App\core
 */
class Application
{
    public static string $ROOT_DIR;

    public string $layout = 'front';
    public array $layoutParams;
    public string $userClass;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public Session $session;
    public View $view;

    public ConnectDB $db;
    public FrontController $frontController;
    public ?User $user = null;
    public ?Page $page = null;
    public string $baseUrl;
    public string $jwtSecretKey;


    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new View();

        $this->db = ConnectDB::getInstance($config['db']);
        $this->userClass = $config['userClass'];
        $this->baseUrl = $config['baseUrl'];
        $this->jwtSecretKey = $config['jwt_secret_key'];
        $this->frontController = new FrontController();
        $this->layoutParams = $this->frontController->layoutParams;

        
        $userClass = $this->userClass;
        $userInstance = new $userClass;
        $primaryValue = $this->session->get('user');

        if($primaryValue){
            $primaryKey = $userInstance->primaryKey();
            $this->user = $userInstance::getOneBy($primaryKey, $primaryValue);
        }else{
            $this->user = null;
        }

        $page = new Page();
        
    }

    
    public function isGuest()
    {
        $token = $this->session->get('authToken');
        $jwt = new JWT($this->jwtSecretKey);
        if (!empty($token)) {
            try {

                $isValid = $jwt->check($token);
                if ($isValid) {
                    // Le JWT est valide
                    // Vous pouvez extraire les informations du payload si nécessaire
                    $payload = $jwt->getPayload($token);
                    $userId = $payload['user_id'];
                    $user = User::getOneBy('id', $userId);

                    if($user){
                        return false;
                    }
                } else {
                    return true;
                }
            } catch (\Exception $e) {
                return true;
            }
        }
        return true;
    }

    public function isAdmin()
    {
        if(Application::$app->user && Application::$app->user->getRole() === 'admin'){
            return true;
        }
        return false;
    }

    public function isEditor()
    {
        if(Application::$app->user && Application::$app->user->getRole() === 'editor'){
            return true;
        }
        return false;
    }


    public function generateUserToken(User $user)
    {
        $jwt = new JWT($this->jwtSecretKey);

        $header = [
            'alg' => 'HS512', 
            'typ' => 'JWT'
        ];
        $payload = [
            'user_id' => $user->getId(), 
            'role' => $user->getRole(),
        ];

        $jwtToken = $jwt->generate($header, $payload);

        return $jwtToken;
    }

    
    public function run()
    {
        try{
            echo $this->router->resolve();
        }catch(\Exception $e){
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController()
    {
        return $this->controller;
    }


    public function setController($controller): void
    {
        $this->controller = $controller;
    }


    public function login(ORM $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('authToken');
        $this->session->remove('user');
    }

}

?>