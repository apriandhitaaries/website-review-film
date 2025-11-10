@extends('layouts.master')
@section('page_title', 'Edit ' . $cast->nama)
@section('name_page', "Edit Data Pemain")
@section('content')

<div class="card">
    <form action="{{ route('casts.update', $cast->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="{{ $cast->nama }}">
            </div>
            <div class="form-group">
                <label for="umur">Umur</label>
                <input type="number" class="form-control" name="umur" id="umur" placeholder="Masukkan Umur" value="{{ $cast->umur }}">
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" name="bio" id="bio" rows="3" placeholder="Tulis bio singkat...">{{ $cast->bio }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('casts.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection