<?php

namespace SMVC\Core\View;

class View
{
    private $env = array();

    private $storage = 'content/public/templates/';

    public function __construct(){}

    public function assign($name, $value)
    {
        $this->env[$name] = $value;
    }

    public function display($template)
    {
        extract($this->env);
        include $this->storage.$template;
        exit;
    }
}