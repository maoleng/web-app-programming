<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Combo extends Model
{

    public string $table = 'combos';

    protected array $fillable = [
        'name', 'price', 'image',
    ];

}