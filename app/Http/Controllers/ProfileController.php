<?php

namespace App\Http\Controllers;

use App\Http\Auth\Authenticatable;
use SMVC\Core\Query\Query;

class ProfileController extends Controller
{
    protected $secure = array(1, 2, 3);

    public function settings()
    {
        $_identity = Authenticatable::getInstance()->getIdentity();
        $id = intval(Query::getParam('id'));
        if($_identity['user_id'] != $id)
        {

        }

    }
}