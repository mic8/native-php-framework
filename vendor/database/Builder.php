<?php

namespace Vendor\Database;

class Builder
{
    private $query = '';
    private $tableName = '';

    public function __construct($tableName = '')
    {
        $this->db = new Connector();
        $this->tableName = $tableName;
    }

    private function toObject($resultSet)
    {
        $arr = [];

        while($result = $resultSet->fetch_assoc()) {
            array_push($arr, $result);
        }

        return $arr;
    }

    public function raw($query = '')
    {
        $result = $this->db->query($query);

        return $this->toObject($result);
    }

    public function where($key = '', $operator = '', $value = '')
    {
        if($this->query == '') {
            $this->query = 'SELECT * FROM ' . $this->tableName . ' where ' . $key . $operator . '\'' . $value . '\'';
        } else {
            $this->query .= ' AND ' . $key . $operator . '\'' . $value . '\'';
        }

        return $this;
    }

    public function all()
    {
        if($this->query != '') {
            throw new \Exception($this->query . ' cannot called by all() method, using get() instead');
        } else {
            $result = $this->db->query('SELECT * FROM ' . $this->tableName);
            return $this->toObject($result);
        }
    }

    public function find($id)
    {
        return $this->where('id', '=', $id)->get();
    }

    public function get()
    {
        if($this->query == '') {
            throw new \Exception('Cannot resolve any query of the database');
        } else {
            $result = $this->db->query($this->query);
            return $this->toObject($result);
        }
    }
}