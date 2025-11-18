@extends('layouts.master')
@section('page_title', 'Edit Data Film')
@section('name_page', "Edit Data Film")
@section('content')

<div class="card">
    <form action="{{ route('admin.films.update', $film->id) }}" method="POST" enctype="multipart/form-data" id="form-edit-film">
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
                    <img src="{{ Storage::disk('s3')->url($film->poster) }}" alt="Poster" style="width: 100px; border-radius: 4px;">
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

            <div class="form-group" id="repeater">
                <div>
                    <label>Aktor & Peran</label>
                </div>

                <div class="mb-2">
                    <button type="button" data-repeater-create class="btn btn-success btn-sm">
                        + Tambah Aktor
                    </button>
                </div>

                <div data-repeater-list="casts">
                    @if(old('casts'))
                    @foreach(old('casts') as $oldCast)
                    <div data-repeater-item class="row mb-2">
                        <div class="col-md-5 form-group">
                            <select name="cast_id" class="form-control" required>
                                <option value="">-- Pilih Aktor --</option>
                                @foreach ($all_casts as $cast)
                                <option value="{{ $cast->id }}" {{ $oldCast['cast_id'] == $cast->id ? 'selected' : '' }}>
                                    {{ $cast->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-5 form-group">
                            <input type="text" name="peran" class="form-control"
                                placeholder="Nama Peran" required value="{{ $oldCast['peran'] }}" />
                        </div>

                        <div class="col-md-2">
                            <button type="button" data-repeater-delete class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach

                    @else
                    @foreach($film->filmCasts as $existingCast)
                    <div data-repeater-item class="row mb-2">
                        <div class="col-md-5 form-group">
                            <select name="cast_id" class="form-control" required>
                                <option value="">-- Pilih Aktor --</option>
                                @foreach ($all_casts as $cast)
                                <option value="{{ $cast->id }}" {{ $existingCast->id == $cast->id ? 'selected' : '' }}>
                                    {{ $cast->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-5 form-group">
                            <input type="text" name="peran" class="form-control"
                                placeholder="Nama Peran" required
                                value="{{ $existingCast->pivot->peran }}" />
                        </div>

                        <div class="col-md-2">
                            <button type="button" data-repeater-delete class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.films.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#repeater').repeater({
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                var self = this;
                Swal.fire({
                    title: 'Yakin mau hapus baris ini?',
                    text: "Aktor & peran ini akan dihapus dari formulir.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(self).slideUp(deleteElement);
                    }
                })
            }
        });
    });
</script>

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
                    min: 1888,
                    max: new Date().getFullYear()
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