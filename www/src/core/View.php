<?php

namespace App\core;


class View
{
    public string $title = '';
    public string $keywords = '';
    public string $desc = '';


     /**
     * renderView
     *
     * @param  mixed $view
     * @param  mixed $params
     */
    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
        include_once Application::$ROOT_DIR."/src/views/$view.php";
    }
   
    
    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        // A fixer // Bouger layoutParams de là
        $layoutParams = Application::$app->layoutParams;
        if (Application::$app->controller){
            $layout = Application::$app->controller->layout;
            $layoutParams = Application::$app->layoutParams;
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