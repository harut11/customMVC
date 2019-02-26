<?php

namespace root\ORM;

class orm
{
    protected $order = [];
    protected $where = [];
    protected $limit;
    protected $sql;
    protected $offset;

    public static function query()
    {
        $query = new static();
        return $query;
    }

    public function getTable()
    {
        $class = get_called_class();
        $parts = explode('\\', $class);
        return strtolower($parts[count($parts) - 1]);
    }

    public function get()
    {
        $this->sql = "SELECT * FROM " . $this->getTable();

        if(!empty($this->limit)) {
            $this->sql .= " LIMIT " . $this->limit;
        }

        if(!empty($this->offset)) {
            $this->sql .= "OFFSET" . $this->offset;
        }

        if(!empty($this->where)) {
            $this->sql .= " WHERE " . $this->where;
        }

        if(!empty($this->order)) {
            $condition = implode(', ', $this->order);
            $this->sql .= ' ORDER BY ' . $condition;
        }

        return $this->execute();
    }

    public function select($row)
    {
        $this->sql = "SELECT $row FROM " . $this->getTable() . " WHERE $this->where";

        return $this->execute();
    }

    public function maxId()
    {
        $this->sql = "SELECT MAX(id) FROM " . $this->getTable();
        return $this->execute();
    }

    public function create(array $attr)
    {
        $table = $this->getTable();

        $cols = implode(', ', array_keys($attr));
        $vals = implode(', ', array_map(function ($item) {
            return "\"$item\"";
        }, $attr));
        $this->sql = "INSERT INTO $table ($cols) VALUES ($vals)";

        return $this->execute();
    }

    public function update(array  $attr)
    {
        $table = $this->getTable();

        $cols = implode(', ', array_keys($attr));
        $vals = implode(',', array_map(function ($item) {
            return "\"$item\"";
        }, $attr));

        $this->sql = "UPDATE $table SET $cols = $vals WHERE $this->where";

        return $this->execute();
    }

    public function where($col, $operator, $val)
    {
        if(is_array($val)) {
            foreach ($val as $key => $v) {
                if(is_string($v)) {
                   $val[$key] = "\"$v\"";
                }
            }
            $val = "(" . implode(',', $val) . ")";
        }

        if(is_string($val)) {
            $val = "'$val'";
        }

        $this->where = "$col $operator $val";

        return $this;
    }

    public function limit($val)
    {
        $this->limit = $val;
        return $this;
    }

    public function order($val)
    {
        $this->order[] = $val;
        return $this;
    }

    public function offset($val)
    {
        $this->offset = $val;
        return $this;
    }

    public function execute()
    {
        return get_connection()->query($this->sql);
    }
}