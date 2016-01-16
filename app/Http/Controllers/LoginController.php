<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use Symfony\Component\HttpFoundation\Request;
use SMVC\Core\Kernel\CSRF;

class LoginController extends Controller
{
    public function index()
    {
        return self::render([], 'login/index.php');
    }

    public function login()
    {
        $request = Request::createFromGlobals();
        if(CSRF::validate($request->request->all()))
        {
            $user = new User();
            $user->validateLogin($request->request->get('login'));
        }
        else
        {
            print_r('access');
        }
        return true;
    }
}