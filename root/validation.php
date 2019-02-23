<?php

namespace root;

class validation
{
    public $errors = [];

    public function setVars($request, $rules)
    {
        foreach ($request as $field => $value) {
            if(isset($rules[$field])) {
                $this->errors = self::defineRules($field, $rules[$field], $request);
            }
        }
    }

    public function defineRules($field, $rules, $request)
    {
        $rules = explode('|', $rules);
        $errors = [];

        foreach ($rules as $rule) {
            $attr = explode(':', $rule);
            $fullName = $attr[0];

            if(count($attr) > 1) {
                $condition = $attr[1];
            }

            $success = '';
        }

        switch ($fullName) {
            case 'required':
                return !empty($rules);
                break;
            case 'min':
                return isset($rules) && strlen($value) <= $condition;
                    break;
            case 'max':
                return isset($rules) && strlen($value) >= $condition;
                    break;
            case 'unique':
                echo self::getErrorMessage('unique');
                break;
            case 'email':
                $pattern = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";
                preg_match($value, $pattern, $matches);
                return count($matches) > 0;
                break;
            default:
                break;
        }
    }

    public function getErrorMessage($rule, $condition = '')
    {
        $messages =  [
            'required' => 'This field is required',
            'min' => 'This field value must be higher then ' . $condition,
            'max' => 'This field value must be lower then ' . $condition,
            'string' => 'This field value must be string',
            'number' => 'This field value must be number',
            'email' => 'Email address is not valid',
            'unique' => 'The field must be unique value'
        ];

        if(isset($messages[$rule])) {
            $message = $messages[$rule];
        }
        return$message;
    }

    public function getErrors()
    {
        if(!empty($this->errors)) {
            $this->errors;
        } else return false;
    }

}