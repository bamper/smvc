<?php

namespace App\Config;

class Web
{
    public static function config()
    {
        return $config = [
            'core' => [
                'db' => [
                    'host' => 'localhost',
                    'user' => 'root',
                    'password' => '100.pudov',
                    'dbname' => 'yii2datagroup'
                ],
            ]
        ];
    }
}