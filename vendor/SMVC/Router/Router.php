<?php

namespace SMVC\Router;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Attribute;
use SMVC\Core\Query\Query;

class Router
{
    /**
     * Singleton handler
     * @var null
     */
    private static $_instance = null;

    /**
     * Router rules mapping array. Change uses to use specific rule
     * @var array
     */
    private $router_mapping = array(
        array(
            'rename' => true, //rename action before execute?
            'rename_method' => 'prefix', //rename method
            'parent' => 'action', //parent to rename
            'ucfirst' => true, //ucfirst for action? Like route /main/index to method       MainController::actionIndex()
            'uses' => false, //use this rule?
        ),
        array(
            'rename' => true,
            'rename_method' => 'suffix',
            'parent' => 'Action',
            'ucfirst' => false,
            'uses' => false,
        ),
        array(
            'rename' => false,
            'rename_method' => '',
            'parent' => '',
            'ucfirst' => false,
            'uses' => true,
        ),
    );

    /**
     * Current router table
     * @var array
     */
    private $router_table = array(
        'controller' => '',
        'action' => ''
    );

    /**
     * Suffix for controllers
     * @var string
     */
    private $controller_suffix = 'Controller';

    /**
     * Default namespace for controllers. Don`t touch this shit!!!
     * @var string
     */
    private $default_namespace = 'App\\Http\\Controllers\\';

    /**
     * Default action name on empty action query
     * @var string
     */
    private $default = 'index';

    /**
     * Static route collection
     * @var array
     */
    private static $route_collection = array();

    private function __construct()
    {
        $request = Request::createFromGlobals();
        $path = $request->getPathInfo();
        $method = $request->server->get('REQUEST_METHOD');
        $static_path = $this->getStaticRoute($path);
        if(empty($static_path))
        {
            $path = trim($path, '/');
            list($controller, $action) = explode('/', $path);
            if(!empty($controller))
            {
                Query::setParams();

                $controller = $this->default_namespace . ucfirst(strtolower($controller)) . $this->controller_suffix;
                $action = $this->renameAction($action);

                $this->router_table['controller'] = $controller;
                $this->router_table['action'] = $action;
                $this->route($controller, $action);
            }
        }
        else
        {
            if($static_path['method'] == $method)
                $this->route($this->default_namespace . $static_path['controller'], $static_path['action']);
            else
                new Exception\RouteErrorException('Its route only for ' . $method . ' method');
        }


    }

    private function __clone(){}

    /**
     * Singleton pattern
     * @return null|Router
     */
    public static function getInstance()
    {
        if(self::$_instance === null)
            self::$_instance = new self();
        return self::$_instance;
    }

    private function getStaticRoute($path)
    {
        return static::$route_collection[$path];
    }

    public static function get($route_path, $controller_method)
    {
        if(empty($controller_method))
            new Exception\RouteErrorException('Wrong way to create route map');

        self::$route_collection[$route_path]['route_path'] = $route_path;
        list(self::$route_collection[$route_path]['controller'],
            self::$route_collection[$route_path]['action']) = explode('@', $controller_method);
        self::$route_collection[$route_path]['method'] = 'GET';
    }

    public static function post($route_path, $controller_method)
    {
        if(empty($controller_method))
            new Exception\RouteErrorException('Wrong way to create route map');

        self::$route_collection[$route_path]['route_path'] = $route_path;
        list(self::$route_collection[$route_path]['controller'],
            self::$route_collection[$route_path]['action']) = explode('@', $controller_method);
        self::$route_collection[$route_path]['method'] = 'POST';
    }

    /**
     * @param $controller
     * @param $method
     */
    private function route($controller, $method)
    {
        if(!call_user_func(array($controller, $method)))
        {
            $request = Request::createFromGlobals();
            new Exception\NotFoundException($request->getPathInfo());
        }

    }

    /**
     * Rule mapper function for rename action
     * @param $action
     * @return string
     */
    private function renameAction($action)
    {
        if(empty($action))
        {
            $action = $this->default;
        }
        foreach($this->router_mapping as $router_rule)
        {
            if($router_rule['uses'] === true)
            {
                $action = ($router_rule['ucfirst'] == true) ? ucfirst($action) : $action;
                if($router_rule['rename'] == true)
                    if($router_rule['rename_method'] == 'prefix')
                        $action = $router_rule['parent'] . $action;
                    elseif($router_rule['rename_method'] == 'suffix')
                        $action = $action . $router_rule['parent'];
            }
        }
        return $action;
    }

    public function getRouterTable()
    {
        return $this->router_table;
    }

    public function getRouterMappingConfig()
    {
        return $this->router_mapping;
    }

    public function getDefaultNamespace()
    {
        return $this->default_namespace;
    }

    public function getDefaultAction()
    {
        return $this->default;
    }

    public function getRouteCollection()
    {
        return static::$route_collection;
    }
}