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
                if(!isAuth()) {
                    return true;
                } else {
                    redirect('/')->setHeader();
                    return false;
                }
                break;
            default:
                return true;
                break;
        }
    }
}