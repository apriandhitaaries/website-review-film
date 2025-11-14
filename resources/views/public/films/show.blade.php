@extends('layouts.public')
@section('navbar_class', 'navbar-dark navbar-on-hero')
@section('navbar_guest_class', 'btn-outline-light')
@section('navbar_text_color', 'text-white')
@section('dropdown_menu_class', 'dropdown-menu-dark')
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
<div class="hero-section-detail d-flex align-items-center justify-content-center text-center">
    <div class="hero-content container">
        <h1 class="display-4 fw-bold">{{ $film->judul }}</h1>
        <p class="lead">
            {{ $film->genre ? $film->genre->nama : 'N/A' }}
            |
            {{ $film->tahun }}
        </p>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $film->poster) }}" class="img-fluid rounded shadow-sm" alt="Poster">
            <h5 class="mt-4">Pemain</h5>
            <hr>
            <ul class="list-group list-group-flush">
                @forelse ($film->filmCasts as $cast)
                <li class="list-group-item px-0">
                    <a href="{{ route('actors.show', $cast) }}" class="text-decoration-none text-dark d-block">
                        <strong>{{ $cast->nama }}</strong>
                        <small class="text-muted d-block">sebagai "{{ $cast->pivot->peran }}"</small>
                    </a>
                </li>
                @empty
                <li class="list-group-item px-0">Belum ada data pemain.</li>
                @endforelse
            </ul>
        </div>

        <div class="col-md-8">
            <h4>Ringkasan</h4>
            <p>{{ $film->ringkasan }}</p>

            <hr class="my-4">
            <h4>Ulasan Penonton ({{ $film->reviews->count() }})</h4>
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
                        <input type="hidden" name="film_id" value="{{ $film->id }}">

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input id="rating" name="rating" class="rating" type="number"
                                data-min="0" data-max="5" data-step="1" data-size="sm"
                                value="{{ old('rating', 0) }}">
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
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline" id="delete-form-{{ $review->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteConfirmation(this)"
                                data-id="{{ $review->id }}">
                                <i class="bi bi-trash-fill"></i>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $("#rating").rating({});
    });
</script>

<script>
    function deleteConfirmation(buttonElement) {
        var id = buttonElement.getAttribute('data-id');
        Swal.fire({
            title: 'Yakin mau hapus?',
            text: "Data akan dihapus selamanya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush