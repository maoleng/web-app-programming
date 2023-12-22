<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Ticket extends Model
{

    public string $table = 'tickets';

    protected array $fillable = [
        'type', 'price', 'seats', 'schedule_id', 'qr_code', 'is_used',
    ];

    protected array $not_string_attributes = [
        'price', 'price', 'is_used',
    ];

    public function seatName(): string
    {
        return str_replace(',', '', $this->seats);
    }
}