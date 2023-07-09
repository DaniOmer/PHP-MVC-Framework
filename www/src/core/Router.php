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
        if($callback === false){
            throw new NotFoundException();
        }
        
        if(is_string($callback)){
            return $this->renderView($callback);
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
    
    /**
     * renderView
     *
     * @param  mixed $view
     * @param  mixed $params
     */
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
        include_once Application::$ROOT_DIR."/src/views/$view.php";
    }
   
    
    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
    
        ob_start();
        include_once Application::$ROOT_DIR."/src/views/layouts/$layout.php";
        return ob_get_clean();
    }

    
    protected function renderOnlyView($view, $params)
    {
        foreach($params as $key => $value){
            $$key = $value;
        }
        
        ob_start();
        include_once Application::$ROOT_DIR."/src/views/$view.php";
        return ob_get_clean();
    }
}



?>