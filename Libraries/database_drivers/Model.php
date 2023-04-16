<?php

namespace Libraries\database_drivers;

use JetBrains\PhpStorm\NoReturn;
use Libraries\database_drivers\mysql\Query;

abstract class Model
{
    use BaseBuilder;

    protected string $table = '';
    protected array $fillable = [];
    protected array $not_string_attributes = [];
    public array $attributes = [];

    public function __construct()
    {
        foreach ($this->fillable as $field) {
            $this->$field = null;
        }
    }

    public function find($id): static|null
    {
        $data = $this->callFind($id);
        if (empty($data)) {
            return null;
        }
        $this->setAttributes($this, $data);

        return $this;
    }

    public function first(): static|null
    {
        $data = $this->callFirst();
        if (empty($data)) {
            return null;
        }
        $this->setAttributes($this, $data);

        return $this;
    }

    public function get($column = []): array
    {
        $result = [];
        $rows = $this->callGet($column);
        foreach ($rows as $row) {
            $model = clone $this;
            $model->setAttributes($model, $row);
            $result[] = $model;
        }

        return $result;
    }

    public function paginate($per_page = 10): array
    {
        $page = request()->get('page') ?? 1;
        $rows = $this->callPaginate($per_page, ($page - 1) * $per_page);

        $result = [];
        foreach ($rows as $row) {
            $model = clone $this;
            $model->setAttributes($model, $row);
            $result[] = $model;
        }

        return $result;
    }

    public function save(): static
    {
        $check = $this->id ?? null;
        $new_data = $this->getData();
        if ($check === null) {
            $this->create($new_data);
        } else {
            $this->update($new_data);
            $this->setAttributes($this, $new_data);
        }

        return $this;
    }

    public function create($data = []): static
    {
        $this->validateFillable(array_keys($data));

        $id = $this->callCreate($data, $this->table);
        $data = ['id' => $id] + $data;
        $this->setAttributes($this, $data);

        return $this;
    }

    public function orderBy($column, $value = 'ASC'): Query
    {
        $this->validateFillable([$column]);

        return $this->callOrderBy($column, $value, $this);
    }

    public function orderByDesc($column): Query
    {
        $this->validateFillable([$column]);

        return $this->callOrderByDesc($column, $this);
    }

    public function where($column, $value): Query
    {
        $this->validateFillable([$column]);

        return $this->callWhere($column, $value, $this);
    }

    public function whereIn($column, $values = []): Query
    {
        $this->validateFillable([$column]);

        return $this->callWhereIn($column, $values, $this);
    }

    private function getData(): array
    {
        $data = [];
        foreach ($this->fillable as $field) {
            $data[$field] = $this->$field;
        }

        return $data;
    }

    #[NoReturn]
    private function validateFillable($fields): void
    {
        $this->fillable[] = 'id';
        $fields = array_diff($fields, $this->fillable);
        if (!empty($fields)) {
            $str_fields = implode(', ', $fields);
            throwHttpException('Invalid fields name: <i>'.$str_fields.'</i> of model '.ucfirst($this->table));
        }
    }
}