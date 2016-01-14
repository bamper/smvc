<?php

namespace App\Http\Models;

use SMVC\Core\Rixi;

class TableSpam extends Rixi\Rixi
{
    protected $table = 'factories';

    protected $primaryKey = 'factory_id';
}