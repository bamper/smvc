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
    }
}