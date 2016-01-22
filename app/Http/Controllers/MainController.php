<?php

namespace App\Http\Controllers;

use App\Http\Auth\Authenticatable;
use App\Http\Models\User;

class MainController extends Controller
{
    public function index()
    {
        return self::render([], 'main/index.php', true, 'dashboard');
    }
}