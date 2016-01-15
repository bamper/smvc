<?php

namespace SMVC\Core\Rixi;

use SMVC\Core\Kernel;
use SMVC\Core\Rixi\QueryBuilder;

class Rixi extends QueryBuilder
{

    public $db;

    protected $raw_table = array();

    protected $structure = array();

    protected $table_prefix = '';

    protected $table = '';

    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->setupTablePrefix();
        $this->up();
        $this->getRawData();
        $this->createStructure();
        $this->setupStructure();
    }

    public function up()
    {
        $this->db = Kernel\Database::getConnection();
    }

    public function down()
    {
        $this->db = null;
    }

    private function getRawData()
    {
        $stm = $this->db->prepare("SELECT * FROM  " . $this->table . " ");
        $stm->execute();
        for($i = 0; $i < $stm->columnCount(); $i++)
        {
            $this->raw_table[] = $stm->getColumnMeta($i);
        }
        return $this->raw_table;
    }

    protected function createStructure()
    {
        if(!empty($this->raw_table))
        {
            foreach($this->raw_table as $table)
            {
                $this->structure[$table['name']]['name'] = $table['name'];
                $this->structure[$table['name']]['nullable'] = ($table['flags'][0] == 'not_null') ? false : true;
                $this->structure[$table['name']]['key'] = (strpos($table['flags'][1], 'key') === false) ? false : true;
                $this->structure[$table['name']]['auto_increment'] = (strpos($table['flags'][1], 'key') === false) ? false : true;
            }
        }
        return $this;
    }

    public function getStructure()
    {
        return $this->structure;
    }

    public function getRawTable()
    {
        return $this->raw_table;
    }

    private function setupTablePrefix()
    {
        $this->table = $this->table_prefix.$this->table;
    }

    private function setupStructure()
    {
        if(!empty($this->structure))
        {
            foreach(array_keys($this->structure) as $column)
            {
                $this->$column;
            }
        }
        return $this;
    }

}