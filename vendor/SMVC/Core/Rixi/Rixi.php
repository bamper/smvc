<?php

namespace SMVC\Core\Rixi;

use SMVC\Core\Kernel;

class Rixi
{

    private $db;

    private $raw_table = array();

    private $structure = array();

    protected $data_types = array(
        'int' => 'integer',
        'float' => 'float',
        'varchar' => 'string',
        'boolean' => 'bool',
        'text' => 'string',
        'bigint' => 'integer',
        'tinyint' => 'integer'
    );

    protected $table = '';

    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->up();
        $this->getRawData();
        $this->createStructure();
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

}