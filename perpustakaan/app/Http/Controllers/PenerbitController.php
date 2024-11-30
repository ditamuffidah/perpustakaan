<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    // Menampilkan daftar penerbit
    public function index()
    {
        $penerbits = Penerbit::all();
        return view('penerbit.index', compact('penerbits'));
    }

    // Menyimpan penerbit baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerbit' => 'required|string|max:255',
        ]);

        Penerbit::create([
            'nama_penerbit' => $request->nama_penerbit,
        ]);

        return redirect()->back()->with('success', 'Penerbit berhasil ditambahkan.');
    }

    // Menampilkan form edit penerbit
    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('penerbit.edit', compact('penerbit'));
    }

    // Mengupdate penerbit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penerbit' => 'required|string|max:255',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update([
            'nama_penerbit' => $request->nama_penerbit,
        ]);

        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil diupdate.');
    }

    // Menghapus penerbit
    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return redirect()->back()->with('success', 'Penerbit berhasil dihapus.');
    }
}
