<?php

namespace App\Http\Models;

use SMVC\Core\Rixi;

class User extends Rixi\Rixi
{
    protected $table = 'user';

    protected $table_prefix = 'datagroup_';

    protected $primaryKey = 'user_id';

    public function register($login, $password, $email, $role)
    {
        if($this->validateLogin($login))
        {
            $this->login = $login;
            $this->password = $this->cryptPassword($password);
            $this->access_token = $this->generateAccessToken();
            $this->role = $role;
            $this->save();
            return true;
        }
        return false;
    }

    public function login()
    {

    }

    public function validateLogin($login)
    {
        $result = $this->rixiSelect(['login'])->rixiWhere('login', $login)->fetch(\PDO::FETCH_ASSOC);
        if(empty($result))
            return true;
        return false;
    }

    private function cryptPassword($password)
    {
        return md5(sha1(md5($password)));
    }

    private function uncryptPassword($password, $crypto)
    {
        return md5(sha1(md5($password))) == $crypto;
    }

    private function generateAccessToken()
    {
        return md5(uniqid());
    }
}