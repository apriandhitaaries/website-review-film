@extends('layouts.master')
@section('page_title', 'Daftar Pemain Film')
@section('name_page', "Daftar Pemain Film")
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('casts.create') }}" class="btn btn-primary btn-sm">+ Tambah Data Pemain Film</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Bio</th>
                    <th style="width: 120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($casts as $cast)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
                        <form action="{{ route('casts.destroy', $cast->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus data {{ $cast->nama }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
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