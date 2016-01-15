<?php

namespace SMVC\Core\View;

class View
{
    private $env = array();

    private $storage;

    public function __construct(){}

    public function assign($name, $value)
    {
        $this->env[$name] = $value;
    }

    public function display($template)
    {
        extract($this->env);
        include '../view/public/templates/'.$template;
        exit;
    }

    public function callStatic($method)
    {
        return $this->$method();
    }

    private function getStorage()
    {
        include '../view/public/templates/';
    }
}