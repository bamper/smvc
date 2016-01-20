<?php

namespace App\Http\Controllers;

use App\Http\Auth\Authenticatable;
use App\Http\Middleware\Middleware;
use SMVC\Core\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class Controller extends Middleware
{
    protected $secure = array(1, 2, 3);

    public static $title = 'Dashboard';

    public static $menu = [
        'dashboard' => [
            'active' => '',
            'route' => '/main/index',
            'name' => 'Dashboard',
            'fa_icon' => 'fa-tachometer',
            'role' => 1
        ],
        'user_control' => [
            'active' => '',
            'route' => '/user/index',
            'name' => 'User management',
            'fa_icon' => 'fa-users',
            'role' => 3
        ],
        'satellites' => [
            'active' => '',
            'route' => '/satellite/index',
            'name' => 'Satellites',
            'fa_icon' => 'fa-space-shuttle',
            'role' => 2
        ]
    ];

    public static $to_draw = array();

    public function __construct()
    {
        $identity = Authenticatable::getInstance()->getIdentity();
        if(empty($identity['auth']))
        {
            RedirectResponse::create('/')->send();
        }
        parent::__construct();
    }

    public function render(array $values, $template = '', $require_layout = false, $active_menu = 'dashboard')
    {
        $view = new View\View();
        $view->assign('title', self::$title);
        self::menu($active_menu);
        $view->assign('_menu', self::$to_draw);
        $view->assign('_identity', Authenticatable::getInstance()->getIdentity());
        foreach($values as $name => $value)
        {
            $view->assign($name, $value);
        }
        $view->display($template, $require_layout);
        return true;
    }

    private function menu($active = 'dashboard')
    {
        $identity = Authenticatable::getInstance()->getIdentity();
        foreach(self::$menu as $menu_name => $menu_item)
        {
            if($active == $menu_name)
                $menu_item['active'] = 'active';
            if($identity['role'] >= $menu_item['role'])
                self::$to_draw[] = $menu_item;
        }
    }

    public function getReferer()
    {
        $request = Request::createFromGlobals();
        var_dump($request->server->all());
        return $request->server->get('HTTP_REFERER');
    }

    public function redirect($url)
    {
        RedirectResponse::create($url)->send();
    }
}