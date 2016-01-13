<?php

namespace App\Http\Models;

class SimpleTable
{
    public $table = array();

    public function createDataTable($cols = 10, $rows = 1000)
    {
        $row = array();
        for($i = 0; $i < $rows; $i++)
        {
            for($j = 0; $j < $cols; $j++)
            {
                $row[$j] = mt_rand(100, 10000000000);
            }
            $this->table[$i] = $row;
        }
        return $this;
    }

    public function getTable()
    {
        return $this->table;
    }
}