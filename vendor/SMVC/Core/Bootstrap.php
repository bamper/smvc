<?php

namespace SMVC\Core;

use SMVC\Core\Registry\Registry;
use SMVC\Core\View\View;
use SMVC\Core\Query\Query;

class Bootstrap
{
    protected $core = array();

    public function run()
    {
        $this->setup();
        foreach($this->core as $name => $value)
        {
            Registry::set($name, $value);
        }
    }

    private function setup()
    {
        $this->core['view'] = new View();
        $this->core['query'] = new Query();
        $this->core['db'] = new \PDO('mysql:host=localhost;port=3306;dbname=laravel;charset=utf8', 'root', '123456', array(
            \PDO::ATTR_EMULATE_PREPARES => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));
    }
}