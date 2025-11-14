<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Cast;

class HomeController extends Controller
{
    public function index()
    {
        $film = Film::with('genre')->orderBy('tahun', 'desc')->paginate(10);
        return view('welcome', ['films' => $film]);
    }

    public function show(Film $film)
    {
        $film->load('genre', 'filmCasts', 'reviews.user');
        return view('public.films.show', ['film' => $film]);
    }

    public function actorShow(Cast $cast)
    {
        $cast->load(['films' => function ($query) {
            $query->orderBy('tahun', 'asc');
        }]);
        return view('public.casts.show', ['cast' => $cast]);
    }
}
