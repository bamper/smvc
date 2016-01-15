<?php

namespace App\Http\Models;

use SMVC\Core\Rixi;

class User extends Rixi\Rixi
{
    protected $table = 'user';

    protected $table_prefix = 'datagroup_';

    protected $primaryKey = 'user_id';
}