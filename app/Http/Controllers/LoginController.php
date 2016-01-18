<?php

namespace App\Http\Controllers;

use App\Http\Auth\Authenticatable;
use App\Http\Models\User;
use Symfony\Component\HttpFoundation\Request;
use SMVC\Core\Kernel\CSRF;
use Symfony\Component\HttpFoundation\RedirectResponse;
use SMVC\Core\View\HtmlHelper;

class LoginController extends Controller
{
    public function index()
    {
        return self::render([], 'login/index.php');
    }

    public function login()
    {
        $auth = Authenticatable::getInstance();
        $request = Request::createFromGlobals();
        $identity = $auth->getIdentity();
        $redirect = new RedirectResponse('/main/index');

        if(!$identity[$auth->session_auth])
        {
            if(CSRF::validate($request->request->all()))
            {
                $user = new User();
                if($user->login($request->request->get('login'), $request->request->get('password'))) {
                    $redirect->send();
                }
                else
                {
                    self::render(['_error' => 'Error'], 'login/index.php');
                }
            }
            else
            {
                print_r('no csrf');
            }
        }
        else
        {
            $redirect->send();
        }
        return true;
    }

    public function logout()
    {
        Authenticatable::getInstance()->destroyIdentity();
        RedirectResponse::create('/')->send();
    }
}