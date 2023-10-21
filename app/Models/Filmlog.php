<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filmlog extends Model
{
    use HasFactory;

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
