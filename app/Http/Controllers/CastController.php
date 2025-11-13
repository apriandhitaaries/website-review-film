<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cast;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::all();
        return view('casts.index', ['casts' => $casts]);
    }

    public function create()
    {
        return view('casts.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'umur' => 'required|numeric',
            'bio'  => 'required',
        ]);

        Cast::create($validateData);
        return redirect(route('casts.index'));
    }

    public function show(Cast $cast)
    {
        return view('casts.show', ['cast' => $cast]);
    }

    public function edit(Cast $cast)
    {
        return view('casts.edit', ['cast' => $cast]);
    }

    public function update(Request $request, Cast $cast)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'umur' => 'required|numeric',
            'bio'  => 'required',
        ]);

        $cast->update($validatedData);
        return redirect(route('casts.index'));
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();
        return redirect(route('casts.index'));
    }
}
