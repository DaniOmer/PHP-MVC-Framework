<?php

namespace App\core\form;

use App\core\Model;
use App\models\User;

class Field extends User
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_EMAIL = 'email';

    public string $type;
    public Model $model;
    public string $attribute;


    public function __construct($model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
        <div style="display:flex; flex-direction:column; margin-bottom:4px;">
            <label>%s</label>
            <input style="padding:5px;" type="%s" name="%s" value="%s" class="%s">
        </div>
        <div style="color:red; font-size:12px; margin-bottom:10px; margin-top:0;" class="invalid-feedback">
            %s
        </div>
        ', 
            $this->model->getLabel($this->attribute),
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attribute)
    );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}