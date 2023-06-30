<?php

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


$app->router->get('/profile', [BackController::class, 'profile']);
$app->router->post('/profile', [BackController::class, 'profile']);
$app->router->get('/users', [BackController::class, 'users']);
$app->router->post('/users', [BackController::class, 'users']);
$app->router->get('/page', [BackController::class, 'page']);
$app->router->post('/page', [BackController::class, 'page']);
$app->router->get('/comment', [BackController::class, 'comment']);
$app->router->post('/comment', [BackController::class, 'comment']);
$app->router->get('/chart', [BackController::class, 'chart']);
$app->router->post('/chart', [BackController::class, 'chart']);


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