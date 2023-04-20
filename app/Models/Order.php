<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Order extends Model
{

    public string $table = 'orders';

    protected array $fillable = [
        'total', 'bank_code', 'transaction_code', 'customer_id', 'ordered_at',
    ];

    protected array $not_string_attributes = [
        'total',
    ];
}