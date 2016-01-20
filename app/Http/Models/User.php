<?php

namespace App\Http\Models;

use App\Http\Auth\Authenticatable;
use SMVC\Core\Rixi;
use Symfony\Component\HttpFoundation\RedirectResponse;

class User extends Rixi\Rixi
{
    protected $table = 'user';

    protected $table_prefix = 'datagroup_';

    protected $primaryKey = 'user_id';

    public function register($login, $password, $email, $role)
    {
        if($this->loginExist($login))
        {
            $this->login = $login;
            $this->password = $this->cryptPassword($password);
            $this->access_token = $this->generateAccessToken();
            $this->role = $role;
            $this->email = $email;
            $this->save();
            return true;
        }
        return false;
    }

    public function login($login, $password)
    {
        $result = $this->validateLogin($login);
        $auth = $this->uncryptPassword($password, $result[0]['password']);
        if($auth)
        {
            Authenticatable::getInstance()->setIdentity(
                $result[0]['login'],
                $result[0]['user_id'],
                $result[0]['role']
            );
            return true;
        }
        return false;
    }

    private function validateLogin($login)
    {
        $result = $this->rixiSelect(['login', 'password', 'user_id', 'role'])->rixiWhere('login', $login)->fetch(\PDO::FETCH_ASSOC);
        if(!empty($result[0]['login']) && $result[0]['login'] == $login)
        {
            return $result;
        }
        return false;
    }

    private function loginExist($login)
    {
        $result = $this->rixiSelect(['login'])->rixiWhere('login', $login)->fetch(\PDO::FETCH_COLUMN);
        if(!empty($result['login']))
            return false;
        return true;
    }

    private function cryptPassword($password)
    {
        return md5(base64_encode(pack('H*', sha1($password))));
    }

    private function uncryptPassword($password, $crypto)
    {
        return md5(base64_encode(pack('H*', sha1($password)))) == $crypto;
    }

    private function generateAccessToken()
    {
        return md5(uniqid());
    }

    public function update($user_id, $data = array())
    {
        $user_data = array(
            'login' => $data['login'],
            'password' => $this->cryptPassword($data['password']),
            'role' => $data['role'],
            'email' => $data['email']
        );
        $this->rixiUpdate($user_data)->rixiWhere($this->primaryKey, $user_id)->execute();
        RedirectResponse::create('/user/index')->send();
        return true;
    }
}