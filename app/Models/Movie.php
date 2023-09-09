<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    protected $fillible = [
       'name',
       'description',
       'image',
       'status',
    ];

}
