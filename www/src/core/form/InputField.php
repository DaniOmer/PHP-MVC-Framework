<?php

namespace App\core\form;

use App\core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_EMAIL = 'email';
    public const TYPE_HIDDEN = 'hidden';

    public string $type;

    public function __construct($model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
 
    public function hiddenField()
    {
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }

    public function renderInput(): string
    {
        $fieldValue = $this->getFieldValue() == '' ? $this->value : $this->getFieldValue();

        return sprintf('<input style="padding:5px;" type="%s" name="%s" value="%s" class="%s">',
        $this->type,
        $this->attribute,
        $fieldValue,
        $this->model->hasError($this->attribute) ? 'is-invalid' : '',
    );
    }
}