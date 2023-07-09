<?php
namespace App\controllers;
 
use App\core\Application;
use App\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'front';
    public array $layoutParams = [];
    public string $action = '';
    /**
     * @var \App\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    protected function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}