<?php

namespace root;

class redirector
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setHeader()
    {
        header('Location: ' .  $this->url);
        return $this;
    }
}