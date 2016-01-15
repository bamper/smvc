<?php
include '../vendor/autoload.php';
ini_set('display_errors', 1);

use Symfony\Component\Debug;
use SMVC\Router\Router;
use SMVC\Core\Bootstrap;

Debug\Debug::enable(1);

$bootstrap = new Bootstrap();
$bootstrap->run();

Router::get('/main/edit', 'MainController@edit');
Router::get('/', 'MainController@index');

Router::getInstance();