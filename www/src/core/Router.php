<?php

namespace App\core;
use App\core\Application;
use App\core\exception\NotFoundException;

/**
 * class Router
 * 
 * @package App\core
 * @param App\core\Request $request
 * @param App\core\Response $response
 */
class Router
{

    public Request $request;
    public Response $response;
    protected array $routes = [];
    
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
  
    
    /**
     * resolve
     *
     * @return void
     */
    public function resolve()
    {
        $path = $this->request->getpath();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            foreach ($this->routes[$method] as $routePath => $routeCallback) {
                // Vérifier si le chemin correspond à un slug
                if ($this->matchSlugRoute($routePath, $path)) {
                    $callback = $routeCallback;
                    break;
                }
            }
            // Vérifier à nouveau si aucun callback n'a été trouvé
            if ($callback === false) {
                throw new NotFoundException();
            }
        }
        
        if(is_string($callback)){
            return Application::$app->view->renderView($callback);
        }

        if(is_array($callback)){
            /** @var \App\core\Controller $controller */
            $controller = new $callback[0];
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    private function matchSlugRoute($routePath, $path)
    {
        // Convertir la route avec slug en une expression régulière
        $routePath = preg_replace('/\//', '\/', $routePath);
        $routePath = preg_replace('/\{([a-zA-Z0-9]+)\}/', '([^\/]+)', $routePath);
        $routePath = '/^' . $routePath . '$/';

        // Vérifier si le chemin correspond à la route avec slug
        return preg_match($routePath, $path);
    }

}

?>