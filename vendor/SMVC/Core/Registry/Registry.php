<?php

namespace SMVC\Core\Registry;

use SMVC\Core\Registry\Exception;

class Registry
{
    private static $registry = array();

    public static function set($var, $value)
    {
        try{
            self::$registry[$var] = $value;
            return true;
        }
        catch (\Exception $e)
        {
            return new Exception\RegistryException('error on set value on registry');
        }
    }

    public static function get($var)
    {
        return self::$registry[$var];
    }
}