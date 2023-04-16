<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class OrderDetail extends Model
{

    public string $table = 'order_detail';

    protected array $fillable = [
        'order_id', 'ticket_id', 'admin_id', 'combo_id', 'amount', 'price',
    ];

}