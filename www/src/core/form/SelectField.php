/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/core/form/SelectField.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

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