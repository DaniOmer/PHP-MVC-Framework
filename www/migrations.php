<?php

use App\core\Application;
use Dotenv\Dotenv;

require "./vendor/autoload.php";


$dotenv = Dotenv::createImmutable(__DIR__);
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
 

$app = new Application(__DIR__, $config);
$app->db->applyMigrations();