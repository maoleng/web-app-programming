<?php

namespace App\Models;

use Libraries\database_drivers\Model;

class User extends Model
{

    public string $table = 'user';

    protected array $fillable = [
        'name',
    ];

    public function getName(): string
    {
        return 'Tao là '.$this->attributes['name'];
    }


}