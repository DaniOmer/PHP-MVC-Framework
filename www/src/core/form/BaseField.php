<?php

namespace App\core\form;

use App\core\Model;

abstract class BaseField
{
    public Model $model;
    public string $attribute;

    public function __construct($model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString()
    {
        return sprintf('
        <div style="display:flex; flex-direction:column; margin-bottom:4px;">
            <label>%s</label>
            %s
        </div>
        <div style="color:red; font-size:12px; margin-bottom:10px; margin-top:0;" class="invalid-feedback">
            %s
        </div>
        ', 
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
    );
    }

    public function getFieldValue()
    {
        $value = $this->model->{'get' . ucfirst($this->attribute)}();
        return $value;
    }
}