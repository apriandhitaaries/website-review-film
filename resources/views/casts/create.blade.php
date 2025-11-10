@extends('layouts.master')
@section('page_title', 'Tambah Pemain Baru')
@section('name_page', "Tambah Pemain Baru")
@section('content')

<div class="card">
    <form action="{{ route('casts.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
                <label for="umur">Umur</label>
                <input type="number" class="form-control" name="umur" id="umur" placeholder="Masukkan Umur">
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" name="bio" id="bio" rows="3" placeholder="Tulis bio singkat..."></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('casts.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection