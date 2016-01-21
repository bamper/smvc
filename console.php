<?php
return null;
require_once 'vendor/autoload.php';

use SMVC\Core\Registry;
use SMVC\Core\Bootstrap;
class Install
{
    public static function setup()
    {
        self::$user['password'] = md5(base64_encode(pack('H*', sha1(self::$user['password']))));
        $db = Registry\Registry::get('db');
        $stm = $db->prepare('INSERT INTO datagroup_user (login, password, email, access_token, role) VALUES (:login, :password, :email, :access_token, :role)');
        $stm->execute(self::$user);
    }

    protected static $user = array(
        'login' => 'root',
        'password' => '100.pudov',
        'email' => 'mail@example.com',
        'access_token' => 'null',
        'role' => 3
    );
}
$boot = new Bootstrap();
$boot->run();
Install::setup();