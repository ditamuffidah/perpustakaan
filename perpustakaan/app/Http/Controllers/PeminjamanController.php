<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $peminjamanList = Peminjaman::all();
        return view('peminjaman.index', compact('peminjamanList'));
    }

    /**
     * Reject the specified resource.
     */
    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        // update status
        $peminjaman->status = 'ditolak';
        $peminjaman->save();
        // Logic to reject the peminjaman
        return redirect()->route('peminjaman')->with('success', 'Peminjaman ditolak.');
    }

    /**
     * Accept the specified resource.
     */
    public function terima($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        // update status
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        // update jumlah buku
        $buku = Buku::find($peminjaman->buku_id);
        $buku->jumlah_buku = $buku->jumlah_buku - 1;
        $buku->save();
        // Logic to accept the peminjaman
        return redirect()->route('peminjaman')->with('success', 'Peminjaman diterima.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
