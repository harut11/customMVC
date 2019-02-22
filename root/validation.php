<?php

namespace root;

class validation
{
    protected $rules;
    protected $request = [];

    public function __construct($request, $rules)
    {
        $this->rules = $rules;
        $this->request = $request;
    }

    public function defineRules()
    {
        foreach ($this->$rules as $key => $value) {
            $parts = explode('|', $value);

            switch (array_values($parts)) {
                case 'required':
                    $this->getErrorMessage('required');
                    break;
            }
        }
    }

    public function getErrorMessage($rule)
    {

    }
}