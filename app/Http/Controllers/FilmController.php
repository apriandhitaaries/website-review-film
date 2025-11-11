<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::with('genre')->get();
        return view('films.index', ['films' => $films]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('films.create', ['genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric|min:1888',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $path = Storage::disk('public')->putFile('posters', $request->file('poster'));
        $validateData['poster'] = $path;
        Film::create($validateData);
        return redirect('/films');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('films.edit', ['film' => $film, 'genres' => $genres]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric|min:1888',
            'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id' => 'required|exists:genres,id',
        ]);
        
        if($request->hasFile('poster')) {
            $old_path = $film->poster;
            $path = Storage::disk('public')->putFile('posters', $request->file('poster'));
            $validateData['poster'] = $path;

            if($old_path) {
                Storage::disk('public')->delete($old_path);
            }
        }

        $film->update($validateData);
        return redirect('/films');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        Storage::disk('public')->delete($film->poster);
        $film->delete();
        return redirect('/films');
    }
}
