<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class HomeController extends Controller
{
    public function index()
    {
        $film = Film::with('genre')->latest()->paginate(12);
        return view('welcome', ['films' => $film]);
    }

    public function show(Film $film)
    {
        $film->load('genre', 'filmCasts', 'reviews.user');
        return view('films.show', ['film' => $film]);
    }
}
