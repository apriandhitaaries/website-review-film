@extends('layouts.master')
@section('page_title', 'Edit Data Genre')
@section('name_page', "Edit Data Genre")
@section('content')

<div class="card">
    <form action="{{ route('admin.genres.update', $genre->id) }}" method="POST" id="form-edit-genre">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Genre</label>
                <input type="text"
                    class="form-control @error('nama') is-invalid @enderror"
                    name="nama" id="nama"
                    value="{{ old('nama', $genre->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.genres.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#form-edit-genre').validate({
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