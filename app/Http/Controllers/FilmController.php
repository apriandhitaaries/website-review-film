<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Cast;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with('genre')->paginate(10);
        return view('films.index', ['films' => $films]);
    }

    public function create()
    {
        $genres = Genre::all();
        $casts = Cast::all();

        return view('films.create', [
            'genres' => $genres,
            'casts' => $casts
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric|min:1888|max:' . date('Y'),
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'casts' => 'required|array',
            'casts.*.cast_id' => 'required|exists:casts,id',
            'casts.*.peran' => 'required|string|max:255'
        ]);

        $path = Storage::disk('public')->putFile('posters', $request->file('poster'));
        $validateData['poster'] = $path;

        $filmData = collect($validateData)
            ->except(['casts'])
            ->toArray();

        $film = Film::create($filmData);

        $castsData = $validateData['casts'];
        $dataPivot = [];
        foreach ($castsData as $cast) {
            $dataPivot[$cast['cast_id']] = ['peran' => $cast['peran']];
        }

        $film->filmCasts()->attach($validateData['casts']);

        return redirect('/films');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Film $film)
    {
        $genres = Genre::all();
        $film->load('filmCasts');
        $all_casts = Cast::all();

        return view('films.edit', [
            'film' => $film,
            'genres' => $genres,
            'all_casts' => $all_casts
        ]);
    }

    public function update(Request $request, Film $film)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'required',
            'tahun' => 'required|numeric|min:1888|max:' . date('Y'),
            'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'casts' => 'required|array',
            'casts.*.cast_id' => 'required|exists:casts,id',
            'casts.*.peran' => 'required|string|max:255'
        ]);

        if ($request->hasFile('poster')) {
            $old_path = $film->poster;
            $path = Storage::disk('public')->putFile('posters', $request->file('poster'));
            $validateData['poster'] = $path;

            if ($old_path) {
                Storage::disk('public')->delete($old_path);
            }
        }

        $filmData = collect($validateData)
            ->except(['casts'])
            ->toArray();

        $film->update($filmData);

        $castsData = $validateData['casts'] ?? [];
        $dataPivot = [];
        foreach ($castsData as $cast) {
            $dataPivot[$cast['cast_id']] = ['peran' => $cast['peran']];
        }

        $film->filmCasts()->sync($dataPivot);

        return redirect('/films');
    }

    public function destroy(Film $film)
    {
        $film->filmCasts()->detach();
        Storage::disk('public')->delete($film->poster);
        $film->delete();
        return redirect('/films');
    }
}
