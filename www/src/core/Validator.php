<?php

namespace App\core;

class Validator
{
    public $data;
    public $listOfErrors = [];
    public function __construct(){
        $this->data = ($this->method == "POST")? $_POST: $_GET;
    }

    public function isValid(): bool
    {
         //$this->config et $this->data
        if( count($this->config["inputs"])+1 != count($this->data) ){
            die("Tentative de hack");
        }

        foreach ($this->config["inputs"] as $name=>$attr)
        {
            if(!isset($this->data[$name])){
                die("Tentative de hack");
            }

            if(!empty($attr["min"]) && !self::minLength($this->data[$name], $attr["min"])){
                $this->listOfErrors[] = $attr["error"];
            }

            if(!empty($attr["max"]) && !self::maxLength($this->data[$name], $attr["max"])){
                $this->listOfErrors[] = $attr["error"];
            }

        }

        return empty($this->listOfErrors);
    }


    public static function minLength($value, $length): bool
    {
        return strlen(trim($value))>=$length;
    }
    public static function maxLength($value, $length): bool
    {
        return strlen(trim($value))<=$length;
    }

    public function isSubmited(): bool
    {
        if($_SERVER["REQUEST_METHOD"] == $this->method &&
            !empty($this->data["submit"])){
            return true;
        }
        return false;
    }


    public static function isValidEmail($email): bool
    {

    }


}