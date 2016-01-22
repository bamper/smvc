<?php

namespace App\Http\Auth;

use Symfony\Component\HttpFoundation\Request;

class Authenticatable
{
    /**
     * Ключ авторизации юзера. булево
     * @var string
     */
    public $session_auth = 'auth';

    //public $session_auth_save_session = 'SMVC_USER_AUTH_SAVE_SESSION';
    /**
     * Login key
     * @var string
     */
    public $session_user_login = 'login';

    /**
     * user_id key
     * @var string
     */
    public $session_user_id = 'user_id';

    /**
     * role key
     * @var string
     */
    public $session_user_role = 'role';
    /**
     * singletone
     * @var null
     */
    private static $_instance = null;

    public static function getInstance()
    {
        if(self::$_instance == null)
            self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Коннектор к редису. Реализовано иммено так, для поддержки подсветки PHPStorm
     * @return \Redis
     */
    private function connect()
    {
        $redis = new \Redis();
        $redis->connect('localhost', 6379);
        return $redis;
    }

    private function __construct()
    {
    }

    private function __clone(){}

    /**
     * Массив идентификатора пользователя
     * @return array
     */
    public function getIdentity()
    {
        $redis = $this->connect();
        $request = Request::createFromGlobals();
        $auth_key = $request->cookies->get('key');
        $_identity = $redis->hGetAll($auth_key);
        if(md5($_identity['login'].$request->server->get('REMOTE_ADDR') == $auth_key))
            return $_identity;
        return array();
    }

    public function setIdentity($login, $user_id, $role)
    {
        $redis = $this->connect();
        $request = new Request();
        $token = md5($login.$request->server->get('REMOTE_ADDR'));
        setcookie('key', $token, (time() + 3600 * 2), '/');
        $redis->hSet($token, $this->session_user_id, $user_id);
        $redis->hSet($token, $this->session_user_login, $login);
        $redis->hSet($token, $this->session_user_role, $role);
        $redis->hSet($token, $this->session_auth, true);
        $redis->expire($token, 3600 * 2);
    }

    public function destroyIdentity()
    {
        $redis = $this->connect();
        $request = new Request();
        $cookies = explode(';', $request->server->get('HTTP_COOKIE'));
        $redis->del($_COOKIE['key']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }
}