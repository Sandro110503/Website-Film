<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = "films";

    protected $fillable = [
        'title',
        'genre',
        'release_year',
        'rating_imdb',
        'poster',
        'synopsis',
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    
}
