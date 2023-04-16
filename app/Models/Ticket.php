<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Ticket extends Model
{

    public string $table = 'tickets';

    protected array $fillable = [
        'type', 'price', 'seats', 'schedule_id', 'qr_code', 'is_used',
    ];

}