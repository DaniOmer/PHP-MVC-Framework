<?php

namespace App\core;
/**
 * class Request
 * 
 * @package App\core
 */
class Request
{

    public function getpath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false){
            return $path;
        }
        return substr($path, 0, $position);

       
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }


    public function getBody()
    {
        $body = [];
        if ($this->method() === 'get') {
            foreach($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
 
        if ($this->method() === 'post') {
            foreach($_POST as $key => $value){
               $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

    public function getQueryParams()
    {
        return $_GET;
    }

    public function getHeader(string $name)
    {
        $headers = getallheaders();
        $name = strtolower($name);

        foreach ($headers as $key => $value) {
            if (strtolower($key) === $name) {
                return $value;
            }
        }

        return null;
    }
}