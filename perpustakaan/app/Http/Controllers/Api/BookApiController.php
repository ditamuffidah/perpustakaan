<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    // Fungsi untuk mendapatkan semua data buku
    public function index()
    {
        // Memuat data buku beserta kategori terkait menggunakan Eager Loading
        $buku = Buku::with('kategori')->get();

        return response()->json($buku, 200);
    }

    // Fungsi untuk mendapatkan detail buku berdasarkan ID
    public function show($id)
    {
        $buku = Buku::with('kategori')->find($id);

        // Jika buku tidak ada
        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json($buku, 200);
    }

    // Fungsi untuk menyimpan data buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_buku' => 'required',
            'kd_buku' => 'required',
            'id_klarifikasi' => 'required|exists:klarifikasi,id', // validasi jika id_klarifikasi ada di tabel klarifikasi
            'id_pengarang' => 'required|exists:pengarang,id', // validasi jika id_pengarang ada di tabel pengarang
            'judul_buku' => 'required',
            'id_penerbit' => 'required|exists:penerbit,id', // validasi jika id_penerbit ada di tabel penerbit
            'kolasi' => 'nullable',
            'keterangan' => 'nullable',
            'jdl_seri' => 'nullable',
            'isbn' => 'nullable',
            'id_subject' => 'required|exists:subject,id', // validasi jika id_subject ada di tabel subject
            'jumlah_buku' => 'required|integer',
            'id_rak' => 'required|exists:rak,id', // validasi jika id_rak ada di tabel rak
            'id_kategori' => 'required|exists:kategori,id', // validasi jika id_kategori ada di tabel kategori
            'tahun' => 'required|integer',
            'asal' => 'nullable',
            'file' => 'nullable|mimes:pdf,docx,xlsx', // validasi untuk file, bisa sesuaikan dengan format yang dibutuhkan
            'edisi' => 'nullable',
            'abstraksi' => 'nullable',
            'bahasa' => 'nullable',
            'biblio' => 'nullable',
            'kota' => 'nullable',
            'ket_sama' => 'nullable',
        ]);
    }
}
