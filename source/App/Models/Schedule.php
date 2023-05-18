<?php

namespace App\Models;

use Carbon\Carbon;
use Libraries\database_drivers\Model;

class Schedule extends Model
{

    public string $table = 'schedules';

    protected array $fillable = [
        'movie_id', 'started_at', 'ended_at',
    ];

    public function startedAt(): Carbon
    {
        return Carbon::make($this->started_at);
    }

    public function endedAt(): Carbon
    {
        return Carbon::make($this->ended_at);
    }


}