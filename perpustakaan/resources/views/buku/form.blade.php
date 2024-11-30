@extends('layouts.app')

@section('title', 'Form Buku')

@section('contents')
<form action="{{ isset($buku) ? route('buku.update', $buku->id) : route('buku.tambah.simpan') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($buku))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ isset($buku) ? 'Form Edit Buku' : 'Form Tambah Buku' }}</h6>
                </div>
                <div class="card-body">

                    <!-- Tambahkan input untuk setiap kolom di tabel -->
                    @php
    $fields = [
        'id_buku' => 'ID Buku', 'kd_buku' => 'Kode Buku', 'id_klarifikasi' => 'ID Klarifikasi',
        'id_pengarang' => 'ID Pengarang', 'judul_buku' => 'Judul Buku', 'id_penerbit' => 'ID Penerbit',
        'kolasi' => 'Kolasi', 'keterangan' => 'Keterangan', 'jdl_seri' => 'Judul Seri',
        'isbn' => 'ISBN', 'id_subject' => 'ID Subject', 'jumlah_buku' => 'Jumlah Buku',
        'id_rak' => 'ID Rak', 'id_kategori' => 'ID Kategori', 'tahun' => 'Tahun',
        'asal' => 'Asal', 'edisi' => 'Edisi', 'abstraksi' => 'Abstraksi',
        'bahasa' => 'Bahasa', 'biblio' => 'Bibliografi', 'kota' => 'Kota',
        'ket_sama' => 'Keterangan Tambahan'
    ];

    // Daftar fields yang menggunakan select
    $selectFields = ['id_klarifikasi', 'id_pengarang', 'id_penerbit', 'id_rak', 'id_subject', 'id_kategori'];
@endphp

@foreach ($fields as $field => $label)
    <div class="form-group">
        <label for="{{ $field }}">{{ $label }}</label>

        @if (in_array($field, $selectFields))
            <select
                class="form-control @error($field) is-invalid @enderror"
                id="{{ $field }}"
                name="{{ $field }}">
                <option value="" disabled selected>Pilih {{ $label }}</option>

                @php
                    $options = $$field ?? []; // Mengambil data array sesuai nama field
                @endphp

                @foreach ($options as $option)
                    <option value="{{ $option->id }}"
                        {{ isset($buku) && $buku->$field == $option->id ? 'selected' : '' }}>
                        {{ $option->nama ?? $option->judul ?? $option->label ?? $option->id }}
                    </option>
                @endforeach
            </select>
        @else
            <input
                type="{{ in_array($field, ['jumlah_buku', 'tahun', 'id_buku', 'id_klarifikasi', 'id_rak', 'id_subject']) ? 'number' : 'text' }}"
                class="form-control @error($field) is-invalid @enderror"
                id="{{ $field }}"
                name="{{ $field }}"
                value="{{ isset($buku) ? $buku->$field : '' }}"
                {{ $field === 'id_buku' && isset($buku) ? 'readonly' : '' }}>
        @endif

        @error($field)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endforeach


                    <div class="form-group">
                        <label for="gambar">Image (JPG, PNG)</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                        @if(isset($buku) && $buku->gambar)
                            <p>Gambar Saat Ini: <img src="{{ asset('storage/' . $buku->gambar) }}" alt="Current Gambar" style="max-width: 200px; max-height: 200px;"></p>
                        @endif
                    </div>

                    <!-- Input untuk file -->
                    <div class="form-group">
                        <label for="file">File (PDF)</label>
                        <input type="file" class="form-control" id="file" name="file">
                        @if(isset($buku) && $buku->file)
                            <p>File Saat Ini: <a href="{{ asset('storage/' . $buku->file) }}" target="_blank">{{ $buku->file }}</a></p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
