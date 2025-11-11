@extends('layouts.master')
@section('page_title', 'Detail Data Pemain')
@section('name_page', "Detail Data Pemain")
@section('content')

<div class="card">
    <div class="card-body">
        <h2>{{ $cast->nama }}</h2>
        <hr>
        <p><strong>Umur:</strong> {{ $cast->umur }} tahun</p>
        <p><strong>Bio:</strong> {{ $cast->bio }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('casts.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection