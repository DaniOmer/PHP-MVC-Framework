<?php

require "../vendor/autoload.php";

use App\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/about', 'about');
$app->router->get('/contact', 'contact');
$app->router->get('/faq', 'faq');

$app->run();