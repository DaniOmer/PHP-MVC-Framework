/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/core/form/BaseField.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

namespace App\core\form;
 
use App\core\Model;

abstract class BaseField
{
    public Model $model;
    public string $attribute;
    public ?string $value = null;

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

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    protected function getAttributeName($key)
    {
        // Vérifiez si la clé correspond exactement à un attribut existant
        if (property_exists($this, $key)) {
            return $key;
        }
        
        // Si la clé ne correspond pas exactement à un attribut
        $words = explode('_', $key);
        $camelCaseWords = array_map('ucfirst', $words);
        $camelCaseKey = lcfirst(implode('', $camelCaseWords));

        // Supprimez les crochets pour obtenir le nom d'attribut valide
        $cleanedKey = rtrim($camelCaseKey, '[]');

        return $cleanedKey;
    }

    public function getFieldValue()
    {
        $value = $this->model->{'get' . ucfirst($this->getAttributeName($this->attribute))}();

        // Vérifiez si la valeur est un tableau et retournez-le directement
        if (is_array($value)) {
            return $value;
        }

        return $value;
    }
}