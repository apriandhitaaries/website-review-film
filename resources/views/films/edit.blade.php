@extends('layouts.master')
@section('page_title', 'Edit Data Film')
@section('name_page', "Edit Data Film")
@section('content')

<div class="card">
    <form action="{{ route('films.update', $film->id) }}" method="POST" enctype="multipart/form-data" id="form-edit-film">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label for="judul">Judul Film</label>
                <input type="text"
                    class="form-control @error('judul') is-invalid @enderror"
                    name="judul" id="judul"
                    value="{{ old('judul', $film->judul) }}">
                @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ringkasan">Ringkasan</label>
                <textarea class="form-control @error('ringkasan') is-invalid @enderror"
                    name="ringkasan" id="ringkasan" rows="3">{{ old('ringkasan', $film->ringkasan) }}</textarea>
                @error('ringkasan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tahun">Tahun Rilis</label>
                <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                    name="tahun" id="tahun" value="{{ old('tahun', $film->tahun) }}">
                @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Poster Saat Ini</label>
                <div>
                    <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" style="width: 100px; border-radius: 4px;">
                </div>
            </div>

            <div class="form-group">
                <label for="poster">Ganti Poster (Opsional)</label>
                <input type="file" class="form-control @error('poster') is-invalid @enderror"
                    name="poster" id="poster">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah poster.</small>
                @error('poster')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <select class="form-control @error('genre_id') is-invalid @enderror"
                    name="genre_id" id="genre_id">
                    <option value="">-- Pilih Genre --</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id', $film->genre_id) == $genre->id ? 'selected' : '' }}>
                        {{ $genre->nama }}
                    </option>
                    @endforeach
                </select>
                @error('genre_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('films.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#form-edit-film').validate({
            rules: {
                judul: {
                    required: true,
                    maxlength: 255
                },
                ringkasan: {
                    required: true,
                },
                tahun: {
                    required: true,
                    number: true,
                    min: 1888
                },
                poster: {
                    accept: "image/*"
                },
                genre_id: {
                    required: true
                }
            },
            messages: {
                judul: {
                    required: "Judul film wajib diisi!",
                    maxlength: "Judul kepanjangan, maksimal 255 karakter."
                },
                ringkasan: {
                    required: "Ringkasan wajib diisi."
                },
                tahun: {
                    required: "Tahun rilis wajib diisi.",
                    number: "Tahun harus berupa angka.",
                    min: "Tahun rilis tidak valid (minimal 1888)."
                },
                poster: {
                    accept: "File yang di-upload harus berupa gambar (jpg, png, gif)."
                },
                genre_id: {
                    required: "Genre wajib dipilih."
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