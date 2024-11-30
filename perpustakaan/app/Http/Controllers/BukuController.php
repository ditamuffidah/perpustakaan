<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Klarifikasi;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Rak;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        // Memuat data buku beserta kategori terkait menggunakan Eager Loading
        $buku = Buku::with('kategori')->get();
        return view('buku.index', compact('buku')); // Mengirim data buku ke view
    }

    public function tambah()
    {
        $id_kategori = Kategori::all();
        $id_klarifikasi = Klarifikasi::all(); // Ambil data klarifikasi
        $id_pengarang = Pengarang::all();
        $id_penerbit = Penerbit::all();
        $id_rak = Rak::all();
        $id_subject = Subject::all();
        return view('buku.form', compact('id_kategori', 'id_klarifikasi', 'id_pengarang', 'id_penerbit', 'id_kategori', 'id_subject', 'id_rak'));
    }

    public function simpan(Request $request)
    {
        // Validasi input dari user
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
            'gambar' => 'required|mimes:jpg,jpeg,png'
        ]);

        // Menangani upload file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('buku_files', 'public');
        }

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('buku_gambar', 'public');
        }

        Buku::create([
            'id_buku'           => $request->id_buku,
            'kd_buku'           => $request->kd_buku,
            'id_klarifikasi'    => $request->id_klarifikasi,
            'id_pengarang'      => $request->id_pengarang,
            'judul_buku'        => $request->judul_buku,
            'id_penerbit'       => $request->id_penerbit,
            'kolasi'            => $request->kolasi,
            'keterangan'        => $request->keterangan,
            'jdl_seri'          => $request->jdl_seri,
            'isbn'              => $request->isbn,
            'id_subject'        => $request->id_subject,
            'jumlah_buku'       => $request->jumlah_buku,
            'id_rak'            => $request->id_rak,
            'id_kategori'       => $request->id_kategori,
            'tahun'             => $request->tahun,
            'asal'              => $request->asal,
            'file'              => $filePath, // Menggunakan $filePath yang sudah diupload
            'edisi'             => $request->edisi,
            'abstraksi'         => $request->abstraksi,
            'bahasa'            => $request->bahasa,
            'biblio'            => $request->biblio,
            'kota'              => $request->kota,
            'ket_sama'          => $request->ket_sama,
            'gambar'            => $gambarPath
        ]);

        return redirect()->route('buku');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $id_kategori = Kategori::all();
        $id_klarifikasi = Klarifikasi::all(); // Ambil data klarifikasi
        $id_pengarang = Pengarang::all();
        $id_penerbit = Penerbit::all();
        $id_rak = Rak::all();
        $id_subject = Subject::all();
        return view('buku.form', compact('buku', 'id_kategori', 'id_klarifikasi', 'id_pengarang', 'id_penerbit', 'id_kategori', 'id_subject', 'id_rak'));
    }

    public function update($id, Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_buku' => 'required',
            'kd_buku' => 'required',
            'id_klarifikasi' => 'required|exists:klarifikasi,id', // Validasi jika id_klarifikasi ada di tabel klarifikasi
            'id_pengarang' => 'required|exists:pengarang,id',     // Validasi jika id_pengarang ada di tabel pengarang
            'judul_buku' => 'required',
            'id_penerbit' => 'required|exists:penerbit,id',       // Validasi jika id_penerbit ada di tabel penerbit
            'kolasi' => 'nullable',
            'keterangan' => 'nullable',
            'jdl_seri' => 'nullable',
            'isbn' => 'nullable',
            'id_subject' => 'required|exists:subject,id',         // Validasi jika id_subject ada di tabel subject
            'jumlah_buku' => 'required|integer',
            'id_rak' => 'required|exists:rak,id',                 // Validasi jika id_rak ada di tabel rak
            'id_kategori' => 'required|exists:kategori,id',       // Validasi jika id_kategori ada di tabel kategori
            'tahun' => 'required|integer',
            'asal' => 'nullable',
            'file' => 'nullable|mimes:pdf,docx,xlsx',             // Validasi untuk file, bisa sesuaikan dengan format yang dibutuhkan
            'edisi' => 'nullable',
            'abstraksi' => 'nullable',
            'bahasa' => 'nullable',
            'biblio' => 'nullable',
            'kota' => 'nullable',
            'ket_sama' => 'nullable'
        ]);

        $buku = Buku::findOrFail($id);
        $filePath = $buku->file;

        // Menangani upload file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            $oldFile = Buku::find($id)->file;
            if ($oldFile) {
                Storage::disk('public')->delete($oldFile);
            }

            // Simpan file baru
            $filePath = $request->file('file')->store('buku_files', 'public');
        }
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('buku_gambar', 'public');
        }

        $data = [
            'id_buku'           => $request->id_buku,
            'kd_buku'           => $request->kd_buku,
            'id_klarifikasi'    => $request->id_klarifikasi,
            'id_pengarang'      => $request->id_pengarang,
            'judul_buku'        => $request->judul_buku,
            'id_penerbit'       => $request->id_penerbit,
            'kolasi'            => $request->kolasi,
            'keterangan'        => $request->keterangan,
            'jdl_seri'          => $request->jdl_seri,
            'isbn'              => $request->isbn,
            'id_subject'        => $request->id_subject,
            'jumlah_buku'       => $request->jumlah_buku,
            'id_rak'            => $request->id_rak,
            'id_kategori'       => $request->id_kategori,
            'tahun'             => $request->tahun,
            'asal'              => $request->asal,
            'edisi'             => $request->edisi,
            'abstraksi'         => $request->abstraksi,
            'bahasa'            => $request->bahasa,
            'biblio'            => $request->biblio,
            'kota'              => $request->kota,
            'ket_sama'          => $request->ket_sama
        ];

        Buku::find($id)->update($data);

        if ($filePath) {
            $buku->file = $filePath;
            $buku->save();
        }
        if ($gambarPath) {
            $buku->gambar = $gambarPath;
            $buku->save();
        }
        return redirect()->route('buku');
    }

    public function hapus($id)
    {
        // Menghapus buku beserta file terkait
        $buku = Buku::findOrFail($id);
        if ($buku->file) {
            Storage::disk('public')->delete($buku->file);
        }
        $buku->delete();

        return redirect()->route('buku');
    }
}
