<?php
namespace App\controllers;

use App\core\Application;

class Controller
{
    public string $layout = 'front';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}