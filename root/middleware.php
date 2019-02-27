<?php

namespace root;

class middleware
{
    public function __construct($condition)
    {
        $this->check($condition);
    }

    public function check($condition)
    {
        switch ($condition) {
            case 'auth':

                break;
        }
    }
}