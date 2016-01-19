<?php
include '../vendor/autoload.php';
error_reporting(1);
ini_set('display_errors', 1);

use Symfony\Component\Debug;
use SMVC\Router\Router;
use SMVC\Core\Bootstrap;

Debug\Debug::enable(1);

$bootstrap = new Bootstrap();
$bootstrap->run();

Router::get('', 'LoginController@index');
Router::get('/', 'LoginController@index');
Router::post('/login/login', 'LoginController@login');
Router::get('/site/index', 'MainController@index');

Router::getInstance();