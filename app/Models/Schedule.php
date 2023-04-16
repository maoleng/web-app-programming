<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Schedule extends Model
{

    public string $table = 'schedules';

    protected array $fillable = [
        'movie_id', 'started_at', 'ended_at',
    ];

}