<?php

namespace App\core;

use App\controllers\Controller;
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
    public string $userClass;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public Session $session;

    public ConnectDB $db;
    public ?User $user = null;
    public string $baseUrl;


    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();

        $this->db = new ConnectDB($config['db']);
        $this->userClass = $config['userClass'];
        $this->baseUrl = $config['baseUrl'];
        
        $userClass = $this->userClass;
        $userInstance = new $userClass;
        $primaryValue = $this->session->get('user');

        if($primaryValue){
            $primaryKey = $userInstance->primaryKey();
            $this->user = $userInstance::getOneBy($primaryKey, $primaryValue);
        }else{
            $this->user = null;
        }
    }

    
    public function isGuest()
    {
        return !self::$app->user && !$this->session->get('user');
    }

    public function run()
    {
        try{
            echo $this->router->resolve();
        }catch(\Exception $e){
            $this->response->setStatusCode($e->getCode());
            echo $this->router->renderView('_error', [
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
        $this->session->remove('user');
    }

}

?>