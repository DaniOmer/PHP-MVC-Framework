<?php

require "../vendor/autoload.php";

use App\core\Application;

$app = new Application();

$app->router->get('/', function(){
    return "Home !";
});

$app->router->get('/contact', function(){
    return "Contactez-nous !";
});

$app->router->get('/a-propos', function(){
    return "À propos";
});

$app->router->get('/faq', function(){
    return "Foire aux questions !";
});

$app->run();