<?php

namespace SMVC\Core;

use SMVC\Core\Registry\Registry;
use SMVC\Core\View\View;
use SMVC\Core\Query\Query;
use App\Config;

class Bootstrap
{
    protected $core = array();

    protected $web_config = array();

    public function __construct()
    {
        return $this;
    }

    public function run()
    {
        $this->config();
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
        $this->core['db'] = new \PDO(
            'mysql:host='. $this->web_config['core']['db']['host'].';port=3306;dbname='.
                $this->web_config['core']['db']['dbname'].';charset=utf8',
            $this->web_config['core']['db']['user'],
            $this->web_config['core']['db']['password'],
            array(
            \PDO::ATTR_EMULATE_PREPARES => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            )
        );
    }

    private function config()
    {
        $this->web_config = Config\Web::config();
    }
}