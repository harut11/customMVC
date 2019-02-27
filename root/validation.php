<?php

namespace root;

use app\Models\Users;

class validation
{
    public $errors = [];
    private $condition = null;
    private $ruleName = null;

    public function setVars($request, $rules)
    {
        foreach ($request as $field => $value) {
            if(isset($rules[$field])) {
                $fieldErrors = $this->defineRules($field, $rules[$field], $request);
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

        foreach ($rules as $key => $rule) {
            $attr = explode(':', $rule);
            $this->ruleName = $attr[0];
            if(count($attr) > 1) {
                $this->condition = $attr[1];
            }

            $success = $this->validateFields($field, $this->ruleName, $this->condition, $request);

            if(!$success) {
                $errors = $this->getErrorMessage($this->ruleName, $attr);
            }
        }
        return $errors;
    }

    public function validateFields($field, $rule, $condition, $request)
    {
        switch ($rule) {
            case 'required':
                return !empty($request[$field]);
                break;
            case 'min':
                return !empty($request[$field]) && strlen($request[$field]) >= $condition;
                break;
            case 'max':
                return !empty($request[$field]) && strlen($request[$field]) <= $condition;
                break;
            case 'email':
                $pattern = "/[a-z0-9]+[_a-z0-9\.-]*[a-z0-9]+@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,20})/";
                return !empty($request[$field]) && preg_match($pattern, $request[$field]);
                break;
            case 'string':
                $pattern = "/^(([A-Za-z]+[\s]{1}[A-Za-z]+)|([A-Za-z]+))$/";
                return !empty($request[$field]) && preg_match($pattern, $request[$field]);
                break;
            case 'unique':
                $existingUser = Users::query()->where('email', '=', $request[$field])->get();
                return !$existingUser;
                break;
            case 'confirm':
                return $_REQUEST['password'] === $request[$field];
                break;
            case 'exists':

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
            'min' => 'This field value must be higher then ' . $condition[1],
            'max' => 'This field value must be lower then ' . $condition[1],
            'string' => 'This field value must be string',
            'number' => 'This field value must be number',
            'email' => 'Email address is not valid',
            'unique' => 'The field must be unique value',
            'confirm' => 'Please enter a same password'
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