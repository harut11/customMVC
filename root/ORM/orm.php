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
        $this->sql = "SELECT * FROM " . self::getTable();

        if(!empty($this->limit)) {
            $this->sql .= " LIMIT " . $this->limit;
        }

        if(!empty($this->offset)) {
            $this->sql .= "OFFSET" . $this->offset;
        }

        if(!empty($this->where)) {
            $condition = implode(' AND ', $this->where);
            $this->sql .= ' WHERE '. $condition;
        }

        if(!empty($this->order)) {
            $condition = implode(', ', $this->order);
            $this->sql .= ' ORDER BY ' . $condition;
        }
        return self::execute();
    }

    public function create($attr)
    {
        $table = self::getTable();

        $cols = implode(', ', array_keys($attr));
        $vals = implode(', ', array_map(function ($item) {
            return "\" $item\"";
        }, $attr));
        $this->sql = "INSERT INTO $table ($cols) VALUES $vals";

        return self::execute();
    }

    public function where($col, $operator, $val)
    {
        if(is_array($val)) {
            foreach ($val as $key => $v) {
                if(is_string($v)) {
                   $val[$key] = "\"$v\"";
                }
            }
            $val = "(" . implode(', ', $val) . ")";
        } else if(is_string($val)) {
            $val = "\"$val\"";
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