<?php

namespace App\Http\Controllers;

use SMVC\Core\Registry\Registry;
use App\Http\Models\User;

class MainController
{
    public function index()
    {
        $view = Registry::get('view');

        $user = new User();
        $user->login = 'root';
        $user->password = 'pass';
        $user->role = 1;
        $user->save();

        $view->display('main/index.php');
    }
}