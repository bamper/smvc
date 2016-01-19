<?php

namespace App\Http\Controllers;

use App\Http\Models\Role;
use App\Http\Models\User;
use SMVC\Core\Kernel\CSRF;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    protected $secure = array(2,3);

    public function index()
    {
        $user = new User();
        $role = new Role();
        $users = $user->all()->fetch();
        foreach($users as $key => $user_data)
        {
            $role_name = $role->rixiSelect(['role_name'])
                ->rixiWhere('role_id', $user_data['role'])
                ->fetch(\PDO::FETCH_COLUMN);
            $users[$key]['role'] = $role_name[0];
        }
        self::render(['users' => $users], 'user/index.php', true, 'user_control');
    }

    public function add()
    {
        $role = new Role();
        $user_roles = $role->all()->fetch(\PDO::FETCH_ASSOC);
        self::render(['roles' => $user_roles], 'user/add.php', true, 'user_control');
    }

    public function create()
    {
        $request = Request::createFromGlobals();
        if(CSRF::validate($request->request->all()))
        {
            $user = new User();
            $res = $user->register(
                $request->request->get('login'),
                $request->request->get('password'),
                $request->request->get('email'),
                $request->request->get('role')
            );
            if($res)
                RedirectResponse::create('/user/index')->send();
        }
    }

    public function delete()
    {

    }

    public function edit()
    {

    }
}