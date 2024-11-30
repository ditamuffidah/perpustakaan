@extends('layouts.app')

@section('title', 'Data Buku')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>

            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            @role('admin|guru') <!-- Hanya admin atau guru yang bisa menambah buku -->
                <a href="{{ route('buku.tambah') }}" class="btn btn-primary mb-3">Tambah Buku</a>
            @endrole
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Buku</th>
                            <th>Kode Buku</th>
                            <th>ID Klarifikasi</th>
                            <th>ID Pengarang</th>
                            <th>ID Penerbit</th>
                            <th>Kolasi</th>
                            <th>Keterangan</th>
                            <th>Judul Seri</th>
                            <th>ISBN</th>
                            <th>ID Subject</th>
                            <th>Jumlah Buku</th>
                            <th>ID Rak</th>
                            <th>ID Kategori</th>
                            <th>Tahun</th>
                            <th>Asal</th>
                            <th>File</th>
                            <th>Edisi</th>
                            <th>Abstraksi</th>
                            <th>Bahasa</th>
                            <th>Bibliografi</th>
                            <th>Kota</th>
                            <th>Keterangan Tambahan</th>
                            @role('admin|guru')
                                <th>Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($buku as $row)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->id_buku }}</td>
                                <td>{{ $row->kd_buku }}</td>
                                <td>{{ $row->id_klarifikasi }}</td>
                                <td>{{ $row->id_pengarang }}</td>
                                <td>{{ $row->judul_buku }}</td>
                                <td>{{ $row->penerbit ? $row->penerbit->nama : 'N/A' }}</td>
                                <td>{{ $row->kolasi }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>{{ $row->jdl_seri }}</td>
                                <td>{{ $row->isbn }}</td>
                                <td>{{ $row->id_subject }}</td>
                                <td>{{ $row->jumlah_buku }}</td>
                                <td>{{ $row->id_rak }}</td>
                                <td>{{ $row->kategori ? $row->kategori->nama : 'N/A' }}</td>
                                <td>{{ $row->tahun }}</td>
                                <td>{{ $row->asal }}</td>
                                <td>{{ $row->file }}</td>
                                <td>{{ $row->edisi }}</td>
                                <td>{{ $row->abstraksi }}</td>
                                <td>{{ $row->bahasa }}</td>
                                <td>{{ $row->biblio }}</td>
                                <td>{{ $row->kota }}</td>
                                <td>{{ $row->ket_sama }}</td>
                                @role('admin|guru')
                                    <td>
                                        <a href="{{ route('buku.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('buku.hapus', $row->id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
