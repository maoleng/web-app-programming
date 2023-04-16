<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Admin extends Model
{

    public string $table = 'admins';

    protected array $fillable = [
        'name', 'email', 'password', 'created_at',
    ];

}