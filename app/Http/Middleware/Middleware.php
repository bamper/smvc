<?php

namespace App\Http\Middleware;

use App\Http\Auth\Authenticatable;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class Middleware
{
    protected $secure = array();

    public function __construct()
    {
        $auth = Authenticatable::getInstance();
        $identity = $auth->getIdentity();
        $request = Request::createFromGlobals();
        $referer = $request->server->get('HTTP_REFERER') ? $request->server->get('HTTP_REFERER') : '/site/index';
        if(!in_array($identity['role'], $this->secure))
            RedirectResponse::create($referer)->send();
    }

    public function selfRedirect($url)
    {
        $redirect = new RedirectResponse($url);
        $identity = Authenticatable::getInstance()->getIdentity();
        if(!empty($identity['auth']))
            $redirect->send();
    }
}