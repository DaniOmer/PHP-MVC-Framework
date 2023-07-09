<?php

namespace App\core;

final class ConnectDB
{
    private static ?ConnectDB $instance = null;
    private \PDO $pdo;
    
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

    public static function getInstance(array $config): ConnectDB
    {
        if (self::$instance === null) {
            self::$instance = new ConnectDB($config);
        }

        return self::$instance;
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }

    public function exec($sql){
        return $this->pdo->exec($sql);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR.'/src/migrations');

        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach($toApplyMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }

            require_once Application::$ROOT_DIR.'/src/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $className");
            $instance->up();
            $this->log("Applied migration $className");

            $newMigrations[] = $migration;
        }

        if(!empty($newMigrations)){
            $this->saveMigration($newMigrations);
        }else{
            $this->log("All migrations are applied !");
        }
        
    }
    

    public function createMigrationsTable()
    {
        $this->exec("CREATE TABLE IF NOT EXISTS migrations (
            id SERIAL PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigration(array $migrations)
    {
        $string = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statment = $this->prepare("INSERT INTO migrations (migration) VALUES 
            $string
        ");

        $statment->execute();
    }

    protected function log($message)
    {
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
    }
}