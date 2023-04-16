<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Order extends Model
{

    public string $table = 'orders';

    protected array $fillable = [
        'total', 'is_paid', 'status', 'user_id', 'ordered_at',
    ];

}