<?php

namespace App\core\form;

class SelectField extends BaseField
{ 
    public array $options = [];

    public function __construct($model, string $attribute, array $options)
    {
        parent::__construct($model, $attribute);
        $this->options = $options;
    }

    public function renderInput(): string
    {
        $optionsHtml = '';
        foreach ($this->options as $value => $label) {
            $selected = $value == $this->getFieldValue() ? 'selected' : '';
            $optionsHtml .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $label);
        }

        // Ajouter une option par défaut sélectionnée
        $defaultSelected = $this->getFieldValue() ? '' : 'selected';
        $optionsHtml = sprintf('<option value="" %s>Pick One</option>', $defaultSelected) . $optionsHtml;

        return sprintf('<select name="%s">%s</select>', $this->attribute, $optionsHtml);
    }
}