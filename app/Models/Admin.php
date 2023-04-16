<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class Admin extends Model
{

    public string $table = 'admins';

    protected array $fillable = [
        'name', 'email', 'password', 'created_at',
    ];

    public function verify($password): bool
    {
        return password_verify($password, $this->password);
    }
}