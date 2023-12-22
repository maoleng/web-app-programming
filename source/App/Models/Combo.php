<?php

namespace App\Models;

use Illuminate\Support\Str;
use Libraries\database_drivers\Model;

class Combo extends Model
{

    public string $table = 'combos';

    protected array $fillable = [
        'name', 'price', 'image',
    ];

    public function limitName(): string
    {
        return Str::limit($this->name, 20);
    }

}