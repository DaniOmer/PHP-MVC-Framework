/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/core/Model.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */
namespace App\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_NAME = 'name';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_SELECT = 'select';
    public const RULE_TEXT = 'text';
    public const RULE_LINK = 'link';

    public array $errors = [];


    public function loadData($data)
    {
        foreach($data as $key => $value){
            if (property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function labels() : array
    {
        return [];
    }

    public function validate()
    {
        foreach($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};
            foreach($rules as $rule){
                $ruleName = $rule;
                if(!is_string($ruleName)){
                    $ruleName = $rule[0];
                }

                if($ruleName === self::RULE_REQUIRED && !$value){
                    $this->addErrorForRules($attribute, self::RULE_REQUIRED);
                }
                if($ruleName === self::RULE_TEXT && $this->validateFieldText($value) === false){
                    $rule['text'] = $this->getLabel($rule['text']);
                    $this->addErrorForRules($attribute, self::RULE_TEXT, $rule);
                }
                if($ruleName === self::RULE_LINK && $this->validateFieldLink($value) === false){
                    $rule['link'] = $this->getLabel($rule['link']);
                    $this->addErrorForRules($attribute, self::RULE_TEXT, $rule);
                }
                if($ruleName === self::RULE_NAME && $this->validateNameField($value) === false){
                    $rule['name'] = $this->getLabel($rule['name']);
                    $this->addErrorForRules($attribute, self::RULE_NAME, $rule);
                }
                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->addErrorForRules($attribute, self::RULE_EMAIL);
                }
                if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']){
                    $this->addErrorForRules($attribute, self::RULE_MIN, $rule);
                }
                if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']){
                    $this->addErrorForRules($attribute, self::RULE_MAX, $rule);
                }
                if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}){
                    $rule['match'] = $this->getLabel($rule['match']);
                    $this->addErrorForRules($attribute, self::RULE_MATCH, $rule);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::getTable();
                
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForRules($attribute, self::RULE_UNIQUE, ['field' => $this->getLabel($attribute)]);
                    }
                }
                if ($ruleName === self::RULE_SELECT && !$value) {
                    $this->addErrorForRules($attribute, self::RULE_SELECT, ['attribute' => $this->getLabel($attribute)]);
                }
            }
        }
        return empty($this->errors);
    }

    
    public function validateNameField($value)
    {
        $nameRegex = '/^(?=.{2,50}$)[A-Za-z](?:[a-zA-Z\s]+|[\'\-](?=[a-zA-Z]))*$/';
        return boolval(preg_match($nameRegex, $value));
    }

    public function validateFieldText($value)
    {
        // Regex de validation 
        $pattern = '/^[\p{L}\p{N}\s\p{P}\p{S}]+$/u';
        return boolval(preg_match($pattern, $value));
    }

    public function validateFieldLink($value)
    {
        // Regex de validation 
        $pattern = '~^(https?:\/\/)?[\w\-]+(\.[\w\-]+)+(\/\S*)?\.(jpeg|jpg|gif|png)$~';
        return boolval(preg_match($pattern, $value));
    }


    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }


    public function addErrorForRules(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessage()[$rule] ?? '';
        foreach($params as $key => $value){
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }


    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }


    public function errorMessage()
    {
        return [
            self::RULE_REQUIRED => 'This field is required.',
            self::RULE_NAME => 'This field must be a valid {name}.',
            self::RULE_EMAIL => 'This field must be valid email address.',
            self::RULE_MIN => 'Minimum length of this field must be {min}.',
            self::RULE_MAX => 'Maximum length of this field must be {max}.',
            self::RULE_MATCH => 'The field must be match the same as {match}.',
            self::RULE_UNIQUE => 'Record with this {field} already exists.',
            self::RULE_SELECT => 'Please select a value for the {attribute}.',
            self::RULE_TEXT => 'This field must be a valid {text}.',
        ];
    }
    
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}