<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', ['genres' => $genres]);
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
        ]);

        Genre::create($validateData);
        return redirect(route('genres.index'));
    }

    public function show(Genre $genre)
    {
        $genre->load('films');
        return view('genres.show', ['genre' => $genre]);
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', ['genre' => $genre]);
    }

    public function update(Request $request, Genre $genre)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
        ]);

        $genre->update($validateData);
        return redirect(route('genres.index'));
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect(route('genres.index'));
    }
}
