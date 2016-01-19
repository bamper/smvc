<?php

namespace App\Http\Auth;


session_start();

class Authenticatable
{
    public $session_auth = 'SMVC_USER_IS_AUTH';

    public $session_auth_save_session = 'SMVC_USER_AUTH_SAVE_SESSION';

    public $session_user_login = 'SMVC_USER_LOGIN';

    public $session_user_id = 'SMVC_USER_ID';

    public $session_user_role = 'SMVC_USER_ROLE';

    private static $_instance = null;

    public static function getInstance()
    {
        if(self::$_instance == null)
            self::$_instance = new self();
        return self::$_instance;
    }

    private function __construct(){}
    private function __clone(){}

    public function getIdentity($key = null)
    {
        $_identity = array(
            'auth' => isset($_SESSION[$this->session_auth]),
            'login' => isset($_SESSION[$this->session_user_login]) ? $_SESSION[$this->session_user_login] : null,
            'user_id' => isset($_SESSION[$this->session_user_id]) ? $_SESSION[$this->session_user_id] : null,
            'role' => isset($_SESSION[$this->session_user_role]) ? $_SESSION[$this->session_user_role] : null
        );
        if(empty($key))
            return $_identity;
        return $_identity[$key];
    }

    public function setIdentity($login, $user_id, $role)
    {
        $_SESSION[$this->session_user_id] = $user_id;
        $_SESSION[$this->session_user_login] = $login;
        $_SESSION[$this->session_user_role] = $role;
        $_SESSION[$this->session_auth] = true;
    }

    public function destroyIdentity()
    {
        session_destroy();
    }
}