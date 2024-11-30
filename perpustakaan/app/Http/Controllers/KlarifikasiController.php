<?php

namespace App\Http\Controllers;

use App\Models\Klarifikasi;
use Illuminate\Http\Request;

class KlarifikasiController extends Controller
{
    // Menampilkan daftar klarifikasi
    public function index()
    {
        $klarifikasis = Klarifikasi::all();  // Mengambil semua data klarifikasi
        return view('klarifikasi.index', compact('klarifikasis'));
    }

    // Menampilkan form untuk menambahkan klarifikasi baru
    public function create()
    {
        return view('klarifikasi.create');
    }

    // Menyimpan klarifikasi baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',  // Pastikan nama klarifikasi diisi dan sesuai format
        ]);

        // Menyimpan data ke database
        Klarifikasi::create([
            'nama' => $request->nama,
        ]);

        // Redirect setelah berhasil menyimpan
        return redirect()->route('klarifikasi.index')->with('success', 'Klarifikasi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit klarifikasi yang ada
    public function edit($id)
    {
        $klarifikasi = Klarifikasi::findOrFail($id);  // Mencari klarifikasi berdasarkan ID
        return view('klarifikasi.edit', compact('klarifikasi'));
    }

    // Memperbarui data klarifikasi yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $klarifikasi = Klarifikasi::findOrFail($id);
        $klarifikasi->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('klarifikasi.index')->with('success', 'Klarifikasi berhasil diperbarui.');
    }

    // Menghapus klarifikasi berdasarkan ID
    public function destroy($id)
    {
        $klarifikasi = Klarifikasi::findOrFail($id);
        $klarifikasi->delete();

        return redirect()->route('klarifikasi.index')->with('success', 'Klarifikasi berhasil dihapus.');
    }
}
