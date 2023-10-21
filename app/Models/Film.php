<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'imdb_id',
        'active',
        'year',
        'type',
        'poster_url',
    ];

    public function filmlogs()
    {
        return $this->hasMany(Filmlog::class);
    }
}
