<?php

namespace root;

class forValidate
{
    public function validate($request, $rules)
    {
        $obj = new validation();
        $obj->setVars($request, $rules);
        $err = $obj->getErrors();

        if($err) {
            echo $err;
        }
    }
}