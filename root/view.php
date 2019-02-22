<?php

namespace root;

class view
{
    protected $contents = '';

    protected function getView($view)
    {
       $path = views_path(str_replace('.', '/', $view) . '.php');
       if(file_exists($path)) {
           ob_start();
           require $path;
           return ob_get_clean();
       }
       return null;
    }

    public function showView($view, $title = '')
    {
        $pageView = $this->getView($view);
        $pageTitle = $title;
        $layout = $this->getView('layouts.main');

        $this->contents = str_replace('@yield', $pageView, $layout);
        $this->contents = str_replace('@title', $pageTitle, $this->contents);

        return $this;
    }

    public function __toString()
    {
        return $this->contents;
    }
}