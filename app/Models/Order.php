<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Order extends Model
{

    public string $table = 'orders';

    protected array $fillable = [
        'total', 'is_paid', 'status', 'customer_id', 'admin_id', 'ordered_at',
    ];

    public function getStatus()
    {
        return [
            '1' => 'Unprocessed',
            '2' => 'Confirm',
            '3' => 'Decline'
        ];
    }
}