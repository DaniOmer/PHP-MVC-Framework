<?php

namespace App\core;

use App\controllers\Controller;
use App\controllers\FrontController;
use App\core\exception\ForbiddenException;
use App\models\Page;
use App\models\User;
use Firebase\JWT\JWT;

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
    public Page $page;
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

        $this->db = new ConnectDB($config['db']);
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
        if (!empty($token)) {
            try {
                $decoded = JWT::decode($token, $this->jwtSecretKey, ['HS512']);
                $userId = $decoded->userId;
                $role = $decoded->userRole;

                if(User::getOneBy('id', $userId) && $userId === $this->user->getId()){
                    return false;
                }
            } catch (\Exception $e) {
                return true;
            }
        }
        return true;
    }


    public function generateUserToken(User $user)
    {
        $issuedAt   = new \DateTimeImmutable();
        $expire = $issuedAt->modify('+3 hours')->getTimestamp();      // Add 60 seconds
        $serverName = "your.domain.name";

        $data = [
            'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $serverName,                       // Issuer
            'nbf'  => $issuedAt->getTimestamp(),         // Not before
            'exp'  => $expire,                           // Expire
            'userId' => $user->getId(),                     // User id
            'userRole' => $user->getRole(),                     // User role
        ];

        $token = JWT::encode($data, $this->jwtSecretKey, 'HS512');;
        return $token;
    }

    
    public function run()
    {
        try{
            echo $this->router->resolve();
        }catch(\Exception $e){
            //$this->response->setStatusCode($e->getCode());
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