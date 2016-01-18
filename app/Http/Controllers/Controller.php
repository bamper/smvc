<?php

namespace App\Http\Controllers;

use App\Http\Auth\Authenticatable;
use SMVC\Core\View;

class Controller extends Authenticatable
{
    public static $title = 'Dashboard';

    public function render(array $values, $template = '', $require = false)
    {
        $view = new View\View();
        $view->assign('title', self::$title);
        $view->assign('_identity', Authenticatable::getInstance()->getIdentity());
        foreach($values as $name => $value)
        {
            $view->assign($name, $value);
        }
        $view->display($template, $require);
        return true;
    }
}