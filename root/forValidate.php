<?php

namespace root;

class forValidate
{
    public function validate($request, $page, $rules)
    {
        $obj = new validation();
        $obj->setVars($request, $rules);
        $err = $obj->getErrors();

        if($err) {
            session::flush('errors', $err);
            session::flush('old', $request);

            if($page === 'register') {
              redirect('/register')->setHeader();
            }
            if($page === 'login') {
                redirect('/login')->setHeader();
            }
            exit();
        }
    }
}