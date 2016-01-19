<?php

namespace App\Http\Controllers;

use App\Http\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = new User();
        $users = $user->all()->fetch();
        self::render(['users' => $users], 'user/index.php', true, 'user_control');
    }

    public function add()
    {

    }

    public function delete()
    {

    }

    public function edit()
    {

    }
}