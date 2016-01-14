<?php

namespace App\Http\Controllers;

use App\Http\Models\TableSpam;
use SMVC\Core\Registry\Registry;
use App\Http\Models\SimpleTable;

class MainController
{
    public function index()
    {
        $view = Registry::get('view');
        $table = new SimpleTable();
        $database = new TableSpam();
        $data = $table->createDataTable()->getTable();
        foreach($data as $row)
        {
            $to_insert = array(
                'user_id' => $row[0],
                'factory_name' => $row[1],
                'source_dir' => $row[2],
                'target_dir' => $row[3],
                'json_params' => $row[4],
                'priority' => $row[5],
                'template_id' => $row[6]
            );
            //$query = $database->rixiInsert($to_insert)->execute();
        }
        $view->display('main/index.php');
    }

    public function bigtable()
    {
        $view = Registry::get('view');
        $rixi = new TableSpam();
        //$result = $rixi->rixiSelect()->rixiWhere('priority', 13211)->rixiAnd('template_id', 1231231)->execute();

        $result = $rixi->all()->execute();//rixiSelect()->rixiRawSql(' WHERE factory_id > 100 ')->execute();
        $view->assign('table', $result);
        $view->display('main/index.php');
        //print_r($result);

    }
}