<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Movie extends Model
{

    public string $table = 'movies';

    protected array $fillable = [
        'name', 'description', 'duration', 'directors', 'actors', 'category', 'premiered_date', 'banner', 'trailer', 'created_at',
    ];

}