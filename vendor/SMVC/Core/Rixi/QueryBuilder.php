<?php

namespace SMVC\Core\Rixi;

use SMVC\Core\Rixi;

class QueryBuilder
{
    public $query;

    public $query_insert;

    public $where;

    public function all()
    {
        $this->query = "SELECT * FROM " . $this->table;
        return $this;
    }

    public function find($id = 0)
    {
        $where = ' WHERE ' . $this->primaryKey . " = " . $id;
        $this->query = "SELECT * FROM " . $this->table . $where;
    }

    public function rixiWhere($key, $value)
    {
        if(!empty($this->where))
            return false;
        $this->where = " WHERE " . $key . " = ".$value;
        return $this;
    }

    public function rixiRawSql($sql)
    {
        if(empty($sql) || empty($this->query))
            return false;
        $this->query .= " ".$sql;
        return $this;
    }

    public function rixiSelect($columns = array())
    {
        if(empty($columns))
            $columns = array('*');
        $this->query = "SELECT ".implode(',', $columns)." FROM ".$this->table;
        return $this;
    }

    public function rixiAnd($key, $value)
    {
        if(empty($this->where))
            return false;
        $this->where .= " AND " . $key ." = ".$value;
        return $this;
    }


    public function rixiInsert($values = array())
    {
        if(empty($values))
            return false;
        $to_set = array();

        $this->query_insert = "INSERT INTO " . $this->table . " SET ";
        foreach($values as $key => $value)
        {
            $to_set[] = implode(" = ", array($key, $value));
        }
        $this->query_insert .= implode(', ', $to_set);
        return $this;
    }

    public function execute()
    {
        if(!empty($this->where))
            $this->query .= $this->where;
        $this->query = empty($this->query_insert) ? $this->query : $this->query_insert;
        $result = empty($this->query_insert) ?
            $this->db->query($this->query)->fetchAll(\PDO::FETCH_ASSOC) :
            $this->db->query($this->query);
        return $result;
    }

    public function __toString()
    {
        return $this->query;
    }
}