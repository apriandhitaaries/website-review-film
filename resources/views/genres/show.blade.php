@extends('layouts.master')
@section('page_title', 'Detail Genre Film')
@section('name_page', "Detail Genre Film")
@section('content')

<div class="card">
    <div class="card-body">
        <h2>{{ $genre->nama }}</h2>
    </div>
    <div class="card-footer">
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection