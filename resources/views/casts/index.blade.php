@extends('layouts.master')
@section('page_title', 'Daftar Pemain Film')
@section('name_page', "Daftar Pemain Film")

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="card-body">
    <a href="{{ route('casts.create') }}" class="btn btn-primary btn-sm mb-3">+ Tambah Data Pemain Film</a>
    <table id="casts_table" class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>Bio</th>
                <th style="width: 120px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($casts as $cast)
            <tr>
                <td>{{ $cast->nama }}</td>
                <td>{{ $cast->umur }}</td>
                <td>{{ Str::limit($cast->bio, 50, '...') }}</td>
                <td>
                    <a href="{{ route('casts.show', $cast->id) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <a href="{{ route('casts.edit', $cast->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <form action="{{ route('casts.destroy', $cast->id) }}" method="POST" class="d-inline" id="delete-form-{{ $cast->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="deleteConfirmation(this)"
                            data-id="{{ $cast->id }}"
                            data-nama="{{ $cast->nama }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada data pemain film.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function() {
        $("#casts_table").DataTable();
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