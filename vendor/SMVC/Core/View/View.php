<?php

namespace SMVC\Core\View;

use SMVC\Core\View\HtmlHelper;

class View
{
    private $env = array();

    public static $storage = '../view/public/templates/';

    public function __construct(){}

    public function assign($name, $value)
    {
        $this->env[$name] = $value;
    }

    public function display($template, $require = false)
    {
        extract($this->env);
        if($require)
        {
            include self::$storage.HtmlHelper::$layout_app_head;
            include self::$storage.HtmlHelper::$layout_app_sidebar;
        }
        include self::$storage.$template;
        if($require)
        {
            include self::$storage.HtmlHelper::$layout_app_footer;
        }
        exit;
    }
}