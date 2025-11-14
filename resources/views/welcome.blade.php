@extends('layouts.public')
@section('navbar_class', 'navbar-dark navbar-on-hero')
@section('navbar_guest_class', 'btn-outline-light')
@section('navbar_text_color', 'text-white')
@section('dropdown_menu_class', 'dropdown-menu-dark')
@push('styles')

@section('content')

<div class="hero-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="display-3 fw-bold">Bingung mau NontonApa?</h1>
        <p class="lead">Temukan film terbaik berdasarkan ulasan jujur dari ribuan pecinta film seperti kamu</p>
    </div>
</div>

<div class="container my-5">
    <h2 class="mb-4">Film Terbaru</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 g-4">

        @forelse ($films as $film)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $film->poster) }}"
                    class="card-img-top"
                    alt="{{ $film->judul }}"
                    style="height: 300px; object-fit: cover;">

                <div class="card-body">
                    <div class="justify-content-between align-items-baseline">
                        <h5 class="card-title fs-6 text-center">{{ $film->judul }} ({{ $film->tahun }})</h5>
                    </div>

                    <p class="card-text text-center">
                        <span class="badge bg-secondary">{{ $film->genre ? $film->genre->nama : 'N/A' }}</span>
                    </p>
                </div>

                <div class="card-footer bg-white border-0">
                    <a href="{{ route('films.show', $film->id) }}" class="btn btn-primary btn-sm w-100">Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p>Belum ada film yang ditambahkan.</p>
        </div>
        @endforelse

    </div>

    <div class="mt-4">
        {{ $films->links() }}
    </div>
</div>

@endsection