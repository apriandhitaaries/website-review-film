<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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
}
