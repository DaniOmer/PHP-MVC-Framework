<?php

namespace App\core\form;

class TextareaField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf('<textarea rows="5" name=%s class="">%s</textarea>', 
    $this->attribute,
    $this->getFieldValue()
    );
    }
} 