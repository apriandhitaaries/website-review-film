@extends('layouts.public')

@push('title')
<title>{{ $film->judul }} ({{ $film->tahun }}) - {{ config('app.name') }}</title>
@endpush

@push('styles')
<style>
    .hero-section-detail {
        position: relative;
        height: 40vh;
        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
        url("{{ asset('storage/' . $film->poster) }}");
        background-size: cover;
        background-position: center 40%;
        color: white;
    }

    .hero-content {
        position: relative;
        z-index: 10;
    }
</style>
@endpush

@section('content')
{{-- === BAGIAN 1: HERO DETAIL === --}}
<div class="hero-section-detail d-flex align-items-center justify-content-center text-center">
    <div class="hero-content container">
        {{-- Tampilkan Judul --}}
        <h1 class="display-4 fw-bold">{{ $film->judul }}</h1>
        {{-- Tampilkan Genre & Tahun --}}
        <p class="lead">
            {{ $film->genre ? $film->genre->nama : 'N/A' }}
            |
            {{ $film->tahun }}
        </p>
    </div>
</div>

{{-- === BAGIAN 2: KONTEN DETAIL (Ringkasan & Ulasan) === --}}
<div class="container my-5">
    <div class="row">

        {{-- Kolom Kiri (Poster & Info) --}}
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $film->poster) }}" class="img-fluid rounded shadow-sm" alt="Poster">
            <h5 class="mt-4">Pemain</h5>
            <hr>
            <ul class="list-group list-group-flush">
                @forelse ($film->filmCasts as $cast)
                <li class="list-group-item px-0">
                    {{-- Nanti ini bisa jadi link ke 'actors.show' --}}
                    <a href="#" class="text-decoration-none text-dark d-block">
                        <strong>{{ $cast->nama }}</strong>
                        <small class="text-muted d-block">sebagai "{{ $cast->pivot->peran }}"</small>
                    </a>
                </li>
                @empty
                <li class="list-group-item px-0">Belum ada data pemain.</li>
                @endforelse
            </ul>
        </div>

        {{-- Kolom Kanan (Ringkasan & Form Ulasan) --}}
        <div class="col-md-8">
            <h4>Ringkasan</h4>
            <p>{{ $film->ringkasan }}</p>

            <hr class="my-4">

            {{--
                  =======================================================
                  INI DIA TEMPAT "CRUD ULASANS" KITA NANTI
                  =======================================================
                --}}
            <h4>Ulasan Penonton ({{ $film->reviews->count() }})</h4>

            {{-- 1. FORMULIR (CUMA MUNCUL KALAU LOGIN) --}}
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @auth
            <div class="card bg-light mb-4">
                <div class="card-body">
                    <h5>Tulis Ulasan Anda</h5>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        {{-- Kita "sembunyiin" ID film-nya --}}
                        <input type="hidden" name="film_id" value="{{ $film->id }}">

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (1-5)</label>
                            <input type="number" name="rating"
                                class="form-control @error('rating') is-invalid @enderror"
                                min="1" max="5" value="{{ old('rating') }}">
                            @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('film_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="isi_review" class="form-label">Ulasan</label>
                            <textarea name="isi_review" class="form-control @error('isi_review') is-invalid @enderror"
                                rows="3" {{ old('isi_review') }}></textarea>
                            @error('isi_review')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                    </form>
                </div>
            </div>
            @else
            <div class="alert alert-info">
                <a href="{{ route('login') }}">Login</a> atau <a href="{{ route('register') }}">Register</a> untuk menulis ulasan
            </div>
            @endauth
            @forelse ($film->reviews->sortByDesc('created_at') as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">
                            <i class="bi bi-person-circle"></i> {{ $review->user->name }}
                        </h6>

                        @auth
                        @can('delete', $review)
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus ulasan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </button>
                        </form>
                        @endcan
                        @endauth
                    </div>
                    <p class="card-text"><small class="text-muted">Rating: {{ $review->rating }}/5</small></p>
                    <p class="card-text">{{ $review->isi_review }}</p>
                </div>
            </div>
            @empty
            <p>Belum ada ulasan untuk film ini. Jadilah yang pertama!</p>
            @endforelse

        </div>

    </div>
</div>
@endsection