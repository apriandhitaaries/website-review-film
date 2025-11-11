@extends('layouts.master')
@section('page_title', 'Tambah Pemain Baru')
@section('name_page', "Tambah Pemain Baru")
@section('content')

<div class="card">
    <form action="{{ route('casts.store') }}" method="POST" id="form-create-cast">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text"
                    class="form-control @error('nama') is-invalid @enderror"
                    name="nama" id="nama" placeholder="Masukkan Nama"
                    value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="umur">Umur</label>
                <input type="number"
                    class="form-control @error('umur') is-invalid @enderror"
                    name="umur" id="umur" placeholder="Masukkan Umur"
                    value="{{ old('umur') }}">
                @error('umur')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control @error('bio') is-invalid @enderror"
                    name="bio" id="bio" rows="3"
                    placeholder="Tulis bio singkat...">{{ old('bio') }}</textarea>
                @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('casts.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#form-create-cast').validate({
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