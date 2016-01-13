<?php

namespace SMVC\Core\Rixi;

use SMVC\Core\Kernel;

class Rixi
{

    private $db;

    private $raw_table;

    private $structure;

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
        $stm = $this->db->prepare("SHOW COLUMNS FROM " . $this->table . " ");
        $stm->execute();
        $this->raw_table = $stm->columnCount();

    }


    protected function parseColumn($column_type)
    {

    }

    public function getTable()
    {
        return $this->raw_table;
    }

}