<?php

use App\controllers\AuthController;
use App\controllers\FrontController;
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
    'userClass' => App\models\User::class
];


$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [FrontController::class, 'home']);
$app->router->get('/about', [FrontController::class, 'about']);
$app->router->get('/contact', [FrontController::class, 'contact']);
$app->router->get('/faq', [FrontController::class, 'faq']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/verify', [AuthController::class, 'verify']);
$app->router->get('/profile', [AuthController::class, 'profile']);


$app->run();