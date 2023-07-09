/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/core/middlewares/AdminEditorMiddleware.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

namespace App\core\middlewares;

use App\core\Application;
use App\core\exception\ForbiddenException;

class AdminEditorMiddleware extends BaseMiddleware
{
    public array $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }


    public function execute()
    {
        if (Application::$app->user && (!Application::$app->isAdmin() || !Application::$app->isEditor())){
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}