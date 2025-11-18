@extends('layouts.public')

@push('title')
<title>{{ $cast->nama }} - {{ config('app.name') }}</title>
@endpush

@section('content')
<div class="container my-5">
    <div class="row">

        <div class="col-md-4">
            <h1 class="display-5 fw-bold">{{ $cast->nama }}</h1>
            <p class="text-muted">Umur: {{ $cast->umur }} tahun</p>

            <h5 class="mt-4">Bio</h5>
            <hr>
            <p>{{ $cast->bio }}</p>
        </div>

        <div class="col-md-8">
            <h4>Film yang Dibintangi ({{ $cast->films->count() }})</h4>
            <hr>

            <div class="list-group">
                @forelse ($cast->films as $film)
                <a href="{{ route('films.show', $film->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                    <img src="{{ Storage::disk('s3')->url($film->poster) }}"
                        alt="{{ $film->judul }}"
                        style="width: 50px; height: 75px; object-fit: cover; border-radius: 4px;"
                        class="me-3">

                    <div class="flex-grow-1">
                        <h6 class="mb-1">{{ $film->judul }} ({{ $film->tahun }})</h6>
                        <small class="text-muted">
                            Berperan sebagai "{{ $film->pivot->peran }}"
                        </small>
                    </div>
                </a>
                @empty
                <p>Aktor ini belum ditambahkan ke film mana pun.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection