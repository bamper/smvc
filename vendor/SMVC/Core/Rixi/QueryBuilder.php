<?php

namespace SMVC\Core\Rixi;

use SMVC\Core\Rixi;

class QueryBuilder
{
    public $query;

    public $query_insert;

    public $where;

    public $and;

    public function all()
    {
        $this->query = "SELECT * FROM " . $this->table;
        return $this;
    }

    public function find($id = 0)
    {
        $where = ' WHERE ' . $this->primaryKey . " = " . $id;
        $this->query = "SELECT * FROM " . $this->table . $where;
        return $this;
    }

    public function rixiWhere($key, $value)
    {
        $this->where = " WHERE " . $key . " = '".$value."' ";
        $this->query .= " WHERE " . $key . " = '".$value."' ";
        return $this;
    }

    public function rixiRawSql($sql)
    {
        if(empty($sql))
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
        $this->and = " AND " . $key ." = ".$value;
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
            $to_set[] = implode(" = ", array($key, "'$value'"));
        }
        $this->query_insert .= implode(', ', $to_set);
        return $this;
    }

    public function execute()
    {
        if(!empty($this->where))
            $this->query_insert .= $this->where;
        $this->db->query($this->query_insert);
    }

    public function fetch($const = null)
    {

        $this->buildQuery();
        return $this->db->query($this->query)->fetchAll(empty($const) ? \PDO::FETCH_ASSOC : $const);
    }

    private function buildQuery()
    {
        if(!empty($this->query))
        {
            if(!empty($this->and))
                $this->query .= $this->and;
        }
        elseif(!empty($this->query_insert))
            $this->query_insert .= $this->where;
    }

    public function save()
    {
        $columns = array();
        foreach(array_keys($this->structure) as $column)
        {
            if($column == $this->primaryKey)
                continue;
            $columns[$column] = !isset($this->$column) ? '' : $this->$column;
        }
        if(!empty($columns))
        {
            $this->rixiInsert($columns)->execute();
        }
    }

    public function rixiUpdate($data = array('col' => 'val'))
    {
        $column_value = array();
        $this->query_insert = "UPDATE " . $this->table . " SET ";
        foreach($data as $column => $value)
        {
            $column_value[] = $column. " = " . "'$value'";
        }
        $this->query_insert .= implode(', ', $column_value);
        return $this;
    }

    public function __toString()
    {
        $this->buildQuery();
        return empty($this->query) ? $this->query_insert : $this->query;
    }
}