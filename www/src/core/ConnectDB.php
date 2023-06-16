<?php

namespace App\core;

final class ConnectDB
{
    private $pdo;
    public function __construct(array $config){
        $db_name =  $config['db_name'];
        $db_driver =  $config['db_driver'];
        $db_host =  $config['db_host'];
        $db_port =  $config['db_port'];
        $db_user =  $config['db_user'];
        $db_pwd =  $config['db_pwd'];
       
        $dsn = $db_driver . ":host=" . $db_host . ";dbname=" . $db_name . ";port=" . $db_port;
        try{
            $this->pdo = new \PDO($dsn, $db_user, $db_pwd);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch (\Exception $e){
            echo "Database connection error: " . $e->getMessage();
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }
}