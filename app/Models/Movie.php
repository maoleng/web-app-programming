<?php

namespace App\Models;

use Illuminate\Support\Str;
use Libraries\database_drivers\Model;

class Movie extends Model
{

    public string $table = 'movies';

    protected array $fillable = [
        'name', 'description', 'duration', 'directors', 'actors', 'category', 'premiered_date', 'banner', 'trailer', 'created_at',
    ];

    public function limitName(): string
    {
        return Str::limit($this->name, 20);
    }

    public function bannerPath()
    {
        return str_starts_with($this->banner, 'http') ? $this->banner : url($this->banner);
    }

    public function prettyCategory(): string
    {
        return $this->getCategories()[$this->category];
    }

    public function getCategories(): array
    {
        return [
            '1' => 'Action',
            '2' => 'Comedy',
            '3' => 'Drama',
            '4' => 'Fantasy',
            '5' => 'Horror',
            '6' => 'Mystery',
            '7' => 'Romance',
            '8' => 'Thriller',
            '9' => 'Western',
        ];
    }
}