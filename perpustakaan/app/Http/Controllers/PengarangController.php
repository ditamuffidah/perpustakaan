<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    // Menampilkan daftar pengarang
    public function index()
    {
        $pengarangs = Pengarang::all();
        return view('pengarang.index', compact('pengarangs'));
    }

    // Menyimpan pengarang baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pengarang' => 'required|string|max:255',
            'biografi' => 'nullable|string', // Tambahkan biografi jika diperlukan
        ]);

        // Menyimpan data ke database
        $pengarang = Pengarang::create([
            'nama_pengarang' => $request->nama_pengarang,
            'biografi' => $request->biografi, // Tambahan untuk menyimpan biografi
        ]);

        // Cek jika permintaan datang dari AJAX, jika iya kirimkan response JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $pengarang->id,
                'nama_pengarang' => $pengarang->nama_pengarang,
            ]);
        }

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan.');
    }

    // Menampilkan form edit pengarang
    public function edit($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('pengarang.edit', compact('pengarang'));
    }

    // Mengupdate pengarang
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_pengarang' => 'required|string|max:255',
            'biografi' => 'nullable|string', // Tambahkan biografi jika diperlukan
        ]);

        // Cari pengarang berdasarkan ID dan update datanya
        $pengarang = Pengarang::findOrFail($id);
        $pengarang->update([
            'nama_pengarang' => $request->nama_pengarang,
            'biografi' => $request->biografi, // Tambahan untuk menyimpan biografi
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil diupdate.');
    }

    // Menghapus pengarang
    public function destroy($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        $pengarang->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil dihapus.');
    }
}
