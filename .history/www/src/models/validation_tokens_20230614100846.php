<?php 

<?php
namespace App\core;
class SQL{

    private $pdo;
    private $table;

    public function __construct(){
        try{
            $this->pdo = new \PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
        }catch (\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = DB_PREFIX.strtolower(end($classExploded));
    }

  public function save(): void
    {
        $attrSetted = get_object_vars($this); //Toutes les propriété qu'on a défint sur notre modele
        $attrNotSetted =get_class_vars(get_class());// Toutes les propriétés qu'on a juste pas setup
        $attrSetted = array_diff_key($attrSetted , $attrNotSetted );
        unset($attrSetted["id"]); // on retire l'id car il est autogénéré par la bdd

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
    }

}