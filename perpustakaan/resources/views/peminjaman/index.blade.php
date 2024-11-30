@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman</h6>

            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            @role('admin|guru') <!-- Hanya admin atau guru yang bisa menambah buku -->
                
            @endrole
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Peminjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Durasi</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Status Pengembalian</th>
                            <th>Denda</th>
                            @role('admin|guru')
                                <th>Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($peminjamanList as $row)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->buku->judul_buku }}</td>
                                <td>{{ $row->tanggal_peminjaman }}</td>
                                <td>{{ $row->durasi }}</td>
                                <td>{{ $row->tanggal_pengembalian }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->status_peminjaman }}</td>
                                <td>{{ $row->denda }}</td>
                                @role('admin|guru')
                                    <td>
                                    @if($row->status == 'menunggu konfirmasi')
                                        <a href="{{ route('peminjaman.terima', $row->id) }}" class="btn btn-success">Terima</a>
                                        <a href="{{ route('peminjaman.tolak', $row->id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menolak?')">Tolak</a>
                                    @endif
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
