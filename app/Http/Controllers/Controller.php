<?php

namespace App\Http\Controllers;

use SMVC\Core\View;

class Controller
{
    public static $title = 'Dashboard';

    public function render(array $values, $template = '')
    {
        $view = new View\View();
        $view->assign('title', self::$title);
        foreach($values as $name => $value)
        {
            $view->assign($name, $value);
        }
        $view->display($template);
        return true;
    }
}