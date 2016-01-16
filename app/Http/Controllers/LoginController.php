<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use SMVC\Core\Kernel\CSRF;

class LoginController extends Controller
{
    public function edit()
    {

    }

    public function index()
    {
        return self::render([], 'login/index.php');
    }

    public function login()
    {
        $request = Request::createFromGlobals();
        if(CSRF::validate($request->request->all()))
        {
            print_r(json_encode(['login' => true]));
        }
        else
        {
            print_r('access');
        }
        return true;
    }
}