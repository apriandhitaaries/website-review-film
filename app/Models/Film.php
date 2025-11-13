<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    protected $fillable = [
        'judul',
        'ringkasan',
        'tahun',
        'poster',
        'genre_id',
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function filmCasts(): BelongsToMany
    {
        return $this->belongsToMany(Cast::class, 'cast_film', 'film_id', 'cast_id')
            ->withPivot('peran');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'film_id');
    }
}
