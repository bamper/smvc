<?php

namespace SMVC\Core\Kernel;

use SMVC\Core\Registry;

class Database
{

    public static function getConnection()
    {
        return Registry\Registry::get('db');
    }
}