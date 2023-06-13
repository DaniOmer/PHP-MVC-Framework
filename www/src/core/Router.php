<?php

namespace App\core;
/**
 * class Router
 * 
 * @package App\core
 */
class Router
{

    public Request $request;
    protected array $routes = [];
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getpath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false){
            return "Not found";
        }

        return call_user_func($callback);

    }

    public function renderView($view)
    {
        include_once __DIR__."/../views/$view.php";
    }
}



?>