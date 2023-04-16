<?php

namespace Libraries\database_drivers\mysql;

use Libraries\database_drivers\BaseBuilder;
use Libraries\database_drivers\Model;

class Query
{
    use BaseBuilder;

    public Model $model;
    public string $str_where;

    public function __construct($model, $db = null)
    {
        $this->model = $model;
        $this->db = $db;
    }

    public function where($column, $value): static
    {
        $value = cleanData($value);
        if (isset($this->str_where)) {
            $add_query = ' AND '.$column.' = "'.$value.'"';
            $this->str_where .= $add_query;
        } else {
            $query = ' WHERE '.$column.' = "'.$value.'"';
            $this->str_where = $query;
        }

        return $this;
    }

    public function whereIn($column, $values): static
    {
        $values = cleanData($values);
        $values = '("'.implode('", "', $values).'")';
        if (isset($this->str_where)) {
            $add_query = ' AND '.$column.' IN '.$values;
            $this->str_where .= $add_query;
        } else {
            $query = ' WHERE '.$column.' IN '.$values;
            $this->str_where = $query;
        }

        return $this;
    }

    public function first(): Model|null
    {
        $data = $this->callFirst();
        if (empty($data)) {
            return null;
        }
        $this->setAttributes($this->model, $data);

        return $this->model;
    }

    public function find($id): Model|null
    {
        $data = $this->callFind($id);
        if (empty($data)) {
            return null;
        }
        $this->setAttributes($this->model, $data);

        return $this->model;
    }

    public function get($column = []): array
    {
        $result = [];
        $rows = $this->callGet($column);
        foreach ($rows as $row) {
            $model = clone $this->model;
            $model->setAttributes($model, $row);
            $result[] = $model;
        }

        return $result;
    }

}