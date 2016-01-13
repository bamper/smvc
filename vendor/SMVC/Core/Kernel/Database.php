<?php

namespace SMVC\Core\Kernel;

use SMVC\Core\Registry;

class Database
{
    public static $db;

    public static function getConnection()
    {
        self::connect();
        return self::$db;
    }

    private static function connect()
    {
        self::$db = Registry\Registry::get('db');
    }
}