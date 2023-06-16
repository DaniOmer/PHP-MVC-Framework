<?php
namespace App\core;

abstract class ORM extends Model{

    private $table;
    private $pdo;
    
    
    public function __construct(){
        $this->table = self::getTable();
        $connectDb = Application::$app->db;
        $this->pdo = $connectDb->getPdo();
    }

    public abstract function primaryKey(): string;
    public abstract function getId(): int;
    public abstract function setId(int $id): void;

    public static function getTable(): string
    {
        $classExploded = explode("\\", get_called_class());
        return "esgi_".strtolower(end($classExploded));
        
    }

  

    public static function populate(int $id)
    {
        return self::getOneBy("id", $id);
    }


    public static function getOneBy($column, $value)
    {
        $connectDb = Application::$app->db;
        $queryPrepared = $connectDb->getPdo()->prepare("SELECT * FROM ".self::getTable().
                            " WHERE ".$column."=:".$column);
        $queryPrepared->execute([$column=>$value]);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $objet = $queryPrepared->fetch();
        return $objet;
    }

    
    public function save(): bool
    {
        $attrSetted = get_object_vars($this); //Toutes les propriété qu'on a défint sur notre modele
        $attrNotSetted = get_class_vars(get_class());// Toutes les propriétés qu'on a juste pas setup
        $attrSetted = array_diff_key($attrSetted , $attrNotSetted );
        unset($attrSetted["id"]); // on retire l'id car il est autogénéré par la bdd
        unset($attrSetted['confirmPassword']); // on retire confirme password

        if(is_numeric($this->getId()) && $this->getId()>0) // si un id est défini on met à jour car supérieur à -1;
        {
            $toUpdate = [];
            foreach ($attrSetted as $key=>$value)
            {
                $toUpdate []= $key."=:".$key; // on construit la requête
            }
            $query= $this->pdo->prepare("UPDATE ".$this->table." SET ".implode(",",$toUpdate )." WHERE id=".$this->getId()); // on prépare la requête de mise à jour

        }else{
            $query= $this->pdo->prepare("INSERT INTO ".$this->table." (".implode(",", array_keys($attrSetted )).") 
                            VALUES (:".implode(",:", array_keys($attrSetted )).")"); // dans ce cas l'id n'est pas set ou alors il est égal à -1. Dans ce cas on sait que c'est un tuple à insérer
        }

        $query->execute($attrSetted); // on execute la query préparée.
        
        return true;
    }

}