<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class User extends Model
{

    public string $table = 'users';

    protected array $fillable = [
        'name', 'email', 'password', 'created_at',
    ];

}