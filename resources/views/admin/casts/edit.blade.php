@extends('layouts.master')
@section('page_title', 'Edit Data Pemain')
@section('name_page', "Edit Data Pemain")
@section('content')

<div class="card">
    <form action="{{ route('admin.casts.update', $cast->id) }}" method="POST" id="form-edit-cast">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text"
                    class="form-control @error('nama') is-invalid @enderror"
                    name="nama" id="nama"
                    value="{{ old('nama', $cast->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="umur">Umur</label>
                <input type="number"
                    class="form-control @error('umur') is-invalid @enderror"
                    name="umur" id="umur"
                    value="{{ old('umur', $cast->umur) }}">
                @error('umur')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control @error('bio') is-invalid @enderror"
                    name="bio" id="bio" rows="3"
                    placeholder="Tulis bio singkat...">{{ old('bio', $cast->bio) }}</textarea>
                @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.casts.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#form-edit-cast').validate({
            rules: {
                nama: {
                    required: true,
                    maxlength: 255
                },
                umur: {
                    required: true,
                    number: true,
                    min: 1
                },
                bio: {
                    required: true
                }
            },
            messages: {
                nama: {
                    required: "Nama wajib diisi, nggak boleh kosong!",
                    maxlength: "Nama kepanjangan, maksimal 255 karakter."
                },
                umur: {
                    required: "Umur wajib diisi.",
                    number: "Umur harus berupa angka.",
                    min: "Umur nggak boleh 0."
                },
                bio: {
                    required: "Bio wajib diisi."
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