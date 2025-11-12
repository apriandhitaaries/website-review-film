@extends('layouts.master')
@section('page_title', 'Tambah Film Baru')
@section('name_page', "Tambah Film Baru")
@section('content')

<div class="card">
    <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" id="form-create-film">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="judul">Judul Film</label>
                <input type="text"
                    class="form-control @error('judul') is-invalid @enderror"
                    name="judul" id="judul" placeholder="Masukkan Judul Film"
                    value="{{ old('judul') }}">
                @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ringkasan">Ringkasan</label>
                <textarea class="form-control @error('ringkasan') is-invalid @enderror"
                    name="ringkasan" id="ringkasan" rows="3"
                    placeholder="Tulis ringkasan...">{{ old('ringkasan') }}</textarea>
                @error('ringkasan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tahun">Tahun Rilis</label>
                <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                    name="tahun" id="tahun" placeholder="Masukkan Tahun Rilis" value="{{ old('tahun') }}">
                @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="poster">Upload Poster</label>
                <input type="file" class="form-control @error('poster') is-invalid @enderror"
                    name="poster" id="poster">
                @error('poster')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="genre_id">Genre</label>
                <select class="form-control @error('genre_id') is-invalid @enderror"
                    name="genre_id" id="genre_id">
                    <option value="">-- Pilih Genre --</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
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
                    <div data-repeater-item class="row mb-2">
                        <div class="col-md-5 form-group">
                            <select name="cast_id" class="form-control" required>
                                <option value="">-- Pilih Aktor --</option>
                                @foreach ($casts as $cast)
                                <option value="{{ $cast->id }}">{{ $cast->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-5 form-group">
                            <input type="text" name="peran" class="form-control" placeholder="Nama Peran (cth: Tony Stark)" required />
                        </div>

                        <div class="col-md-2">
                            <button type="button" data-repeater-delete class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>

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
        $('#form-create-film').validate({
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
                    required: true,
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
                    min: "Tahun rilis tidak valid (minimal 1888).",
                    max: "Tahun rilis tidak valid (maksimal tahun sekarang)."
                },
                poster: {
                    required: "Poster wajib di-upload.",
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