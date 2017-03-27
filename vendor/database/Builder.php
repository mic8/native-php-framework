<?php

namespace Vendor\Database;

class Builder
{
    private $query = '';
    private $tableName = '';

    protected $fillable = [];
    protected $hidden = [];
    protected $primaryKey = '';

    public function __construct($tableName = '', $fillable = [], $hidden = [], $primaryKey)
    {
        $this->db = new Connector();
        $this->tableName = $tableName;
        $this->fillable = $fillable;
        $this->hidden = $hidden;
        $this->primaryKey = $primaryKey;
    }

    private function toObject($resultSet)
    {
        $arr = [];

        while($result = $resultSet->fetch_assoc()) {
            array_push($arr, $result);
        }

        return $arr;
    }

    public function selectRaw($query = '')
    {
        $result = $this->db->query($query);

        return $this->toObject($result);
    }

    public function where($key = '', $operator = '', $value = '')
    {
        if($this->query == '') {
            $this->query = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $key . $operator . '\'' . $value . '\'';
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
        $this->where($this->primaryKey, '=', $id);

        return $this;
    }

    public function create($params = [])
    {
        $keys = [];
        $values = [];

        foreach($params as $key => $value) {
            $flag = false;
            for($i = 0; $i < count($this->fillable); $i++) {
                $fill = $this->fillable[$i];
                if($fill == $key) {
                    $flag = true;
                }
            }

            if($flag) {
                array_push($keys, $key);
                array_push($values, $value);
            }
        }

        $keyJoin = implode(',', $keys);

        $values = array_map(function($data) {
            return '\'' . $data . '\'';
        }, $values);
        $valueJoin = implode(',', $values);

        //query
        $query = 'INSERT INTO ' . $this->tableName . '(' . $keyJoin . ') VALUES(' . $valueJoin . ')';
        $created = $this->createRaw($query);

        if($created) {
            return $this->last();
        } else {
            return false;
        }
    }

    public function createRaw($query = '')
    {
        $result = $this->db->prepare($query);

        return $result->execute();
    }

    public function delete()
    {
        $data = $this->get()[0];

        return $this->deleteWhere($this->primaryKey, '=', $data['id']);
    }

    public function deleteWhere($key = '', $operator = '', $value = '')
    {
        $query = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $key . $operator . '\'' . $value . '\'';

        return $this->deleteRaw($query);
    }

    public function deleteRaw($query = '')
    {
        $prepare = $this->db->prepare($query);

        return $prepare->execute();
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

    public function last()
    {
        $result = $this->selectRaw('SELECT * FROM ' . $this->tableName . ' ORDER BY ' . $this->primaryKey . ' DESC');

        if(count($result)) {
            return $result[0];
        }

        return false;
    }

    /**
     * Danger zone
     */
    public function truncate()
    {
        $query = 'TRUNCATE ' . $this->tableName;
        $truncate = $this->db->prepare($query);

        return $truncate->execute();
    }
}