@extends('layouts.master')
@section('page_title', 'Tambah Genre Film')
@section('name_page', "Tambah Genre Film")
@section('content')

<div class="card">
    <form action="{{ route('admin.genres.store') }}" method="POST" id="form-create-genre">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Genre</label>
                <input type="text"
                    class="form-control @error('nama') is-invalid @enderror"
                    name="nama" id="nama" placeholder="Masukkan Nama Genre"
                    value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.genres.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#form-create-genre').validate({
            rules: {
                nama: {
                    required: true,
                    maxlength: 100
                }
            },
            messages: {
                nama: {
                    required: "Nama genre wajib diisi, nggak boleh kosong!",
                    maxlength: "Nama kepanjangan, maksimal 255 karakter."
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush