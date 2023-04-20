<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Order extends Model
{

    public string $table = 'orders';

    protected array $fillable = [
        'total', 'bank_code', 'transaction_code', 'customer_id', 'admin_id', 'ordered_at',
    ];

}