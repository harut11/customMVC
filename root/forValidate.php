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
            session::flush('errors', $err);
            session::flush('old', $request);
            redirect(session::get('previous_url'))->setHeader();
            exit();
        }
    }
}