<?php

namespace App\Http\Controllers;

use App\Http\Models\Simple;
use SMVC\Core\Registry\Registry;
use Symfony\Component\HttpFoundation\Request;
use SMVC\Core\Query\Query;
use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function index()
    {
        $view = Registry::get('view');
        $view->display('main/index.php');
    }
}