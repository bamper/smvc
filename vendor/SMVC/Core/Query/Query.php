<?php

namespace SMVC\Core\Query;

use Symfony\Component\HttpFoundation\Request;

class Query
{
    public static $params = array();

    public static function getParam($name)
    {
        return self::$params[$name];
    }

    public static function setParams()
    {
        $request = Request::createFromGlobals();
        $path = $request->getPathInfo();
        $query = explode('/', trim($path, '/'));
        if(!empty($query))
        {
            $buf = '';
            foreach($query as $key => $iterator)
            {
                if($key % 2 === 0)
                {
                    self::$params[$iterator];
                    $buf = $iterator;
                }
                else
                {
                    self::$params[$buf] = $iterator;
                }
            }
        }
    }
}