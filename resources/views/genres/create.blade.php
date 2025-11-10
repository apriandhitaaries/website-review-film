@extends('layouts.master')
@section('page_title', 'Tambah Genre Film')
@section('name_page', "Tambah Genre Film")
@section('content')

<div class="card">
    <form action="{{ route('genres.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Genre</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Genre">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('genres.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>

    @endsection