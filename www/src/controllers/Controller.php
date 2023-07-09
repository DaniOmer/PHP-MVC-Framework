<?php
namespace App\controllers;
 
use App\core\Application;
use App\core\middlewares\BaseMiddleware;
use App\models\Page;

class Controller
{
    public string $layout = 'front';
    public array $layoutParams = [];
    public string $action = '';
    /**
     * @var \App\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    // A gérer 
    public function __construct()
    {
        $this->loadMenuParams();
    }

    public function loadMenuParams()
    {
        $pages = Page::getAllBy('on_menu', 'show');
        if ($pages) {
            foreach ($pages as $page) {
                $this->layoutParams[] = [
                    'value' => $page->getTitle(),
                    'url' => $page->getPageUri()
                ];
            }
        }
    }
    // À gérer 

    
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