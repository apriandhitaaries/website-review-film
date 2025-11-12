<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $fillable = ['nama']; 

    public function films(): HasMany
    {
        return $this->hasMany(Film::class, 'genre_id');
    }
}
