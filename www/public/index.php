<?php

/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/public/index.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

use App\controllers\AuthController;
use App\controllers\FrontController;
use App\controllers\BackController;
use App\core\Application;
use Dotenv\Dotenv;

require "../vendor/autoload.php";


$path = dirname(__DIR__);

$dotenv = Dotenv::createImmutable($path);
$dotenv->load();

$config = [
    'db' => [
        'db_name' =>  $_ENV['DB_NAME'],
        'db_driver' =>  $_ENV['DB_DRIVER'],
        'db_host' =>  $_ENV['DB_HOST'],
        'db_port' =>  $_ENV['DB_PORT'],
        'db_user' =>  $_ENV['DB_USER'],
        'db_pwd' =>  $_ENV['DB_PWD']
    ],
    'userClass' => App\models\User::class,
    'baseUrl' => $_ENV['BASE_URL'],
    'jwt_secret_key' => $_ENV['JWT_SECRET_KEY']
];


$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [FrontController::class, 'home']);
$app->router->get('/{slug}', [FrontController::class, 'home']);
$app->router->post('/{slug}', [FrontController::class, 'home']);

$app->router->get('/contact', [FrontController::class, 'contact']);
$app->router->post('/contact', [FrontController::class, 'contact']);


$app->router->get('/dashboard/profile', [BackController::class, 'profile']);
$app->router->post('/dashboard/profile', [BackController::class, 'profile']);
$app->router->get('/dashboard/comment', [BackController::class, 'comment']);
$app->router->post('/dashboard/comment', [BackController::class, 'comment']);
$app->router->get('/dashboard/chart', [BackController::class, 'chart']);
$app->router->post('/dashboard/chart', [BackController::class, 'chart']);

$app->router->get('/dashboard/users/create', [BackController::class, 'create']);
$app->router->post('/dashboard/users/create', [BackController::class, 'create']);
$app->router->get('/dashboard/users/manage', [BackController::class, 'manage']);
$app->router->post('/dashboard/users/manage', [BackController::class, 'manage']);

$app->router->get('/dashboard/profile/edit', [BackController::class, 'profile']);
$app->router->post('/dashboard/profile/edit', [BackController::class, 'profile']);
$app->router->get('/dashboard/profile/reset-password', [BackController::class, 'reset']);
$app->router->post('/dashboard/profile/reset-password', [BackController::class, 'reset']);


$app->router->get('/dashboard/page/create', [BackController::class, 'createPage']);
$app->router->post('/dashboard/page/create', [BackController::class, 'createPage']);
$app->router->get('/dashboard/page/manage', [BackController::class, 'managePage']);
$app->router->post('/dashboard/page/manage', [BackController::class, 'managePage']);


$app->router->get('/dashboard/template/homepage', [BackController::class, 'homepageTemplate']);
$app->router->post('/dashboard/template/homepage', [BackController::class, 'homepageTemplate']);
$app->router->get('/dashboard/template/gallery', [BackController::class, 'galleryTemplate']);
$app->router->post('/dashboard/template/gallery', [BackController::class, 'galleryTemplate']);
$app->router->get('/dashboard/template/blog', [BackController::class, 'blogTemplate']);
$app->router->post('/dashboard/template/blog', [BackController::class, 'blogTemplate']);



$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/verify', [AuthController::class, 'verify']);
$app->router->get('/recover-password', [AuthController::class, 'recover']);
$app->router->post('/recover-password', [AuthController::class, 'recover']);
$app->router->get('/reset-password', [AuthController::class, 'reset']);
$app->router->post('/reset-password', [AuthController::class, 'reset']);
$app->router->get('/dashboard', [AuthController::class, 'dashboard']);


$app->run();