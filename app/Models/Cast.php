<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'umur',
        'bio'
    ];

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(
            Film::class,
            'cast_film',
            'cast_id',
            'film_id'
        )
            ->withPivot('peran');
    }
}
