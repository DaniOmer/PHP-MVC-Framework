<?php

require "./vendor/autoload.php";

use App\core\Application;

$config = [
    'db' => [
        'db_name' => getenv('DB_NAME'),
        'db_driver' => getenv('DB_DRIVER'),
        'db_host' => getenv('DB_HOST'),
        'db_port' => getenv('DB_PORT'),
        'db_user' => getenv('DB_USER'),
        'db_pwd' => getenv('DB_PASSWORD')
    ],
    'userClass' => App\models\User::class,
    'baseUrl' => getenv('BASE_URL'),
    'jwt_secret_key' => getenv('JWT_SECRET_KEY')
];
 

Application::$app->db->applyMigrations();