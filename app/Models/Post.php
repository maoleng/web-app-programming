<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Post extends Model
{

    public string $table = 'post';

    protected array $fillable = [
        'name', 'email', 'gender', 'price', 'is_free',
    ];

    protected array $not_string_attributes = [
        'is_free', 'price', 'gender',
    ];

    public function getName(): string
    {
        return 'Tao là '.$this->name;
    }


}