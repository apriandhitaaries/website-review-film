@extends('layouts.master')
@section('page_title', 'Daftar Film')
@section('name_page', "Daftar Film")

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <a href="{{ route('films.create') }}" class="btn btn-primary btn-sm mb-3">+ Tambah Data Film</a>
        <table id="films_table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Film</th>
                    <th style="width: 100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($films as $film)
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <img src="{{ asset('storage/' . $film->poster) }}"
                                    alt="{{ $film->judul }}"
                                    style="width: 60px; height: 90px; object-fit: cover; border-radius: 4px;">
                            </div>

                            <div class="flex-grow-1">
                                <h5 class="mb-1">{{ $film->judul }}</h5>
                                <p class="mb-1 text-muted">
                                    <span class="badge bg-secondary">
                                        {{ $film->genre ? $film->genre->nama : 'N/A' }}
                                    </span>
                                    | {{ $film->tahun }}
                                </p>
                                <small>{{ Str::limit($film->ringkasan, 150, '...') }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('films.destroy', $film->id) }}" method="POST" class="d-inline" id="delete-form-{{ $film->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteConfirmation(this)"
                                data-id="{{ $film->id }}"
                                data-judul="{{ $film->judul }}">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function() {
        $("#films_table").DataTable();
    });
</script>

<script>
    function deleteConfirmation(buttonElement) {
        var id = buttonElement.getAttribute('data-id');
        var judul = buttonElement.getAttribute('data-judul');
        Swal.fire({
            title: 'Yakin mau hapus?',
            text: "Data " + judul + " akan dihapus selamanya!",
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