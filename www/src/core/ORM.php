<?php

namespace App\core;

abstract class ORM extends Model{

    private $table;
    private $pdo;
    protected $isNewRecord = true;
    
    
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
        $queryPrepared = $connectDb->prepare("SELECT * FROM " . self::getTable() . " WHERE " . $column . " = :" . $column);
        $queryPrepared->bindValue(':' . $column, $value);
        $queryPrepared->execute();
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        // Récupération de la première ligne de résultats
        $objet = $queryPrepared->fetch();

        if ($objet) {
            // Convertir les valeurs booléennes en true ou false
            foreach ($objet as $key => $val) {
                if (is_bool($val)) {
                    $objet->$key = ($val === true);
                }
            }
        }
        return $objet;
    }

    
    public function updateOne($column, $value): bool
    {
        $connectDb = Application::$app->db;
        $query = "UPDATE " . $this->table . " SET " . $column . " = :value WHERE id = :id";
        $queryPrepared = $connectDb->prepare($query);
        
        if (is_bool($value)) {
            $value = $value ? 1 : 0; // Conversion de la valeur booléenne en entier (1 pour true, 0 pour false)
        }
        $queryPrepared->bindValue(':value', $value);
        $queryPrepared->bindValue(':id', $this->getId());
        $queryPrepared->execute();

        return true;
    }

    public static function getAllBy($column, $value, $conditions = [])
    {
        $connectDb = Application::$app->db;
        $query = "SELECT * FROM " . self::getTable() . " WHERE " . $column . " = :" . $column;

        foreach ($conditions as $conditionColumn => $conditionValue) {
            $query .= " AND " . $conditionColumn . " = :" . $conditionColumn;
        }

        $queryPrepared = $connectDb->prepare($query);
        $queryPrepared->bindValue(':' . $column, $value);

        foreach ($conditions as $conditionColumn => $conditionValue) {
            $queryPrepared->bindValue(':' . $conditionColumn, $conditionValue);
        }

        $queryPrepared->execute();
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        $objects = $queryPrepared->fetchAll();

        foreach ($objects as $object) {
            foreach ($object as $key => $val) {
                if (is_bool($val)) {
                    $object->$key = ($val === true);
                }
            }
        }

        return $objects;
    }



    public static function getAll()
    {
        $connectDb = Application::$app->db;
        $query = "SELECT * FROM " . self::getTable();
        $statement = $connectDb->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_CLASS, get_called_class());

        // Convertir les valeurs booléennes en true ou false
        foreach ($result as $obj) {
            foreach ($obj as $key => $val) {
                if (is_bool($val)) {
                    $obj->$key = ($val === true);
                }
            }
        }

        return $result;
    }

    
    public function delete($id): bool
    {
        if ($id === null) {
            return false;
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->bindValue(':id', $id);
        $queryPrepared->execute();

        return true;
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
