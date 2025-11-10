@extends('layouts.master')
@section('page_title', 'Edit ' . $genre->nama)
@section('name_page', "Edit Data Genre")
@section('content')

<div class="card">
    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Genre" value="{{ $genre->nama }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('genres.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection