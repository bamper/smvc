<?php

namespace App\Http\Controllers;

use App\Http\Models\RixiFixture;
use SMVC\Core\Registry\Registry;
use App\Http\Models\SimpleTable;

class MainController
{
    public function index()
    {
        $view = Registry::get('view');
        $table = new SimpleTable();
        $view->assign('table', $table->createDataTable()->getTable());
        $view->display('main/index.php');
    }

    public function rixi()
    {
        var_dump(new RixiFixture());
    }
}