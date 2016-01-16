<?php

namespace SMVC\Core\View;

class View
{
    private $env = array();

    public static $storage = '../view/public/templates/';

    public function __construct(){}

    public function assign($name, $value)
    {
        $this->env[$name] = $value;
    }

    public function display($template)
    {
        extract($this->env);
        include self::$storage.$template;
        exit;
    }
}