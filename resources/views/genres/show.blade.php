@extends('layouts.master')
@section('page_title', 'Detail Genre Film')
@section('name_page', "Detail Genre Film")
@section('content')

<div class="card">
    <div class="card-body">
        <h3>Semua Film dalam Genre: {{ $genre->nama }}</h3>
    <p>Total ada {{ $genre->films->count() }} film.</p>
    <hr>
    <table class="table table-bordered table-hover align-middle">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 70px">Poster</th>
                <th>Judul Film</th>
                <th>Tahun Rilis</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($genre->films as $film)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $film->poster) }}" 
                            alt="{{ $film->judul }}" 
                            style="width: 50px; height: 75px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td>{{ $film->judul }}</td>
                    <td>{{ $film->tahun }}</td>
                </tr>
            @empty
                {{-- Ini akan muncul kalau belum ada film di genre ini --}}
                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada film yang ditambahkan ke genre ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div class="card-footer">
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection