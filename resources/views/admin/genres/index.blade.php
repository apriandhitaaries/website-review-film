@extends('layouts.master')
@section('page_title', 'Daftar Genre Film')
@section('name_page', "Daftar Genre Film")

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <a href="{{ route('admin.genres.create') }}" class="btn btn-primary btn-sm mb-3">+ Tambah Genre Film</a>
        <table id="genres_table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Genre</th>
                    <th style="width: 120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genres as $genre)
                <tr>
                    <td>{{ $genre->nama }}</td>
                    <td>
                        <a href="{{ route('admin.genres.show', $genre->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" class="d-inline" id="delete-form-{{ $genre->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteConfirmation(this)"
                                data-id="{{ $genre->id }}"
                                data-nama="{{ $genre->nama }}">
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
        $("#genres_table").DataTable();
    });
</script>

<script>
    function deleteConfirmation(buttonElement) {
        var id = buttonElement.getAttribute('data-id');
        var nama = buttonElement.getAttribute('data-nama');
        Swal.fire({
            title: 'Yakin mau hapus?',
            text: "Data " + nama + " akan dihapus selamanya!",
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