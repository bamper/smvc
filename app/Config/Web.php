<?php

namespace App\Config;;

class Web
{
    public static function config()
    {
        return $config = [
            'core' => [
                'db' => [
                    'host' => 'localhost',
                    'user' => 'root',
                    'password' => '123456',
                    'dbname' => 'yii2datagroup'
                ],
            ]
        ];
    }
}