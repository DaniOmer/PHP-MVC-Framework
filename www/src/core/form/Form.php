<?php
 
namespace App\core\form;

use App\core\Model;

class Form
{

    public static function begin($action, $method, $options = [])
    {
        $class = isset($options['class']) ? 'class="' . $options['class'] . '"' : 'form-control';
        echo sprintf('<form action="%s" method="%s" %s>', $action, $method, $class);
        return new Form();
    }


    public static function end()
    {
        echo '</form>';
    }

    public function input(Model $model, $attribute){
        return new InputField($model, $attribute);
    }

    public function textarea(Model $model, $attribute){
        return new TextareaField($model, $attribute);
    }

    public function select(Model $model, $attribute, $options){
        return new SelectField($model, $attribute, $options);
    }
}