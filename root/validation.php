<?php

namespace root;

class validation
{
    public $errors = [];

    public function setVars($request, $rules)
    {
        foreach ($request as $field => $value) {
            if(isset($rules[$field])) {
                $fieldErrors = self::defineRules($field, $rules[$field], $request);
                if(!empty($fieldErrors)) {
                    $this->errors[$field] = $fieldErrors;
                }
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

                $success = self::validateFields($field, $fullName, $condition, $request);

                if(!$success) {
                    $errors = self::getErrorMessage($fullName, $attr);
                }
            }
        }
        return $errors;
    }

    public function validateFields($field, $fullName, $condition, $request)
    {
        switch ($fullName) {
            case 'required':
                return !empty($request[$field]);
                break;
            case 'min':
                return isset($request[$field]) && strlen($request[$field]) >= $condition;
                break;
            case 'max':
                return isset($request[$field]) && strlen($request[$field]) <= $condition;
                break;
            case 'unique':

                break;
            case 'email':
                $pattern = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";
                preg_match($request[$field], $pattern, $matches);
                return count($matches) > 0;
                break;
            default:
                return true;
                break;
        }
    }

    public function getErrorMessage($rule, $condition = '')
    {
        $messages =  [
            'required' => 'This field is required',
            'min' => 'This field value must be higher then ' . $condition[0],
            'max' => 'This field value must be lower then ' . $condition[0],
            'string' => 'This field value must be string',
            'number' => 'This field value must be number',
            'email' => 'Email address is not valid',
            'unique' => 'The field must be unique value'
        ];

        if(isset($messages[$rule])) {
            $message = $messages[$rule];
            return $message;
        }
        return false;
    }

    public function getErrors()
    {
        if(!empty($this->errors)) {
            return $this->errors;
        }
        return false;
    }

}