<?php

namespace App\Http\Models;

use SMVC\Core\Rixi\Rixi;

class Role extends Rixi
{
    protected $table = 'role';

    protected $table_prefix = 'datagroup_';

    protected $primaryKey = 'role_id';
}