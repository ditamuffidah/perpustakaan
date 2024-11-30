<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class PeminjamanController extends Controller
{
    public function pinjamBuku(Request $request){
        $request->validate([
            'id_buku' => 'required|integer',
            'isbn' => 'required|string',
            'id_anggota' => 'required|integer',
            'tanggal_peminjaman' => 'required|date',
            'lama_peminjaman' => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
        ]);
        $buku = Buku::find($request->id_buku);
        if($buku->jumlah_buku < 1){
            return response()->json(['success'=>false, 'message'=>'Stok buku tidak tersedia.']);
        }
        $peminjaman = new Peminjaman();
        $peminjaman->buku_id = $request->id_buku;
        $peminjaman->isbn = $request->isbn;
        $peminjaman->user_id = $request->id_anggota;
        $peminjaman->tanggal_peminjaman = $request->tanggal_peminjaman;
        $peminjaman->lama_peminjaman = $request->lama_peminjaman;
        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
        $peminjaman->status = 'menunggu konfirmasi';
        $peminjaman->save();

        return response()->json(['success' => true, 'message' => 'Buku berhasil dipinjam!']);
    }

    public function updateProfile(Request $request){
        $request->validate([
            'id_user' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::find($request->id_user);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.']);
        }

        // Check for duplicate email
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser && $existingUser->id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Email already in use by another account.']);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
    }

    public function bukuTerpinjam($user_id){
        $peminjaman = Peminjaman::where('user_id',$user_id)->where('status','=','dipinjam')->first();
        $book = Buku::find($peminjaman->buku_id);
        $book->file = asset('storage/' . $book->file);
        $book->gambar = asset('storage/' . $book->gambar);
        $book->penulis = $book->pengarang()->first()->nama_pengarang;
        $book->kategori = $book->kategori()->first()->nama;
        $book->id_peminjaman = $peminjaman->id;
        $book->tanggal_pengembalian = $peminjaman->tanggal_pengembalian;
        $book->tanggal_peminjaman = $peminjaman->tanggal_peminjaman;
        $book->lama_peminjaman = $peminjaman->lama_peminjaman;

        return response()->json($book);
    }

    public function tambahWaktu(Request $request){
        $request->validate([
            'id_buku' => 'required|integer',
            'id_peminjaman' => 'required|integer',
            'id_anggota' => 'required|integer',
            'tambah_hari' => 'required|integer|min:1',
        ]);

        $peminjaman = Peminjaman::find($request->id_peminjaman);
        if (!$peminjaman) {
            return response()->json(['success' => false, 'message' => 'Peminjaman not found.']);
        }

        // Update the return date by adding the additional days
        $peminjaman->tanggal_pengembalian = date('Y-m-d', strtotime($peminjaman->tanggal_pengembalian . ' + ' . $request->tambah_hari . ' days'));
        $peminjaman->lama_peminjaman = $peminjaman->lama_peminjaman + $request->tambah_hari;
        $peminjaman->save();

        return response()->json(['success' => true, 'message' => 'Perpanjangan peminjaman berhasil!']);
    }

    public function notifikasi($user_id){
        $tanggal_sekarang = date('Y-m-d');
        $peminjaman = Peminjaman::where('user_id', $user_id)
                ->where('status', '=', 'dipinjam')
                ->where('tanggal_pengembalian', '<', $tanggal_sekarang)
                ->get();

        if ($peminjaman->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No data found.']);
        }
        foreach($peminjaman as $pinjam){
            $book = Buku::find($pinjam->buku_id); // Corrected to use $pinjam instead of $peminjaman
            $pinjam->file = asset('storage/' . $book->file);
            $pinjam->gambar = asset('storage/' . $book->gambar);
            $pinjam->penulis = $book->pengarang()->first()->nama_pengarang;
            $pinjam->kategori = $book->kategori()->first()->nama;
            $pinjam->id_buku = $book->id;
            $pinjam->isbn = $book->isbn;
            $pinjam->id_peminjaman = $pinjam->id;
            $pinjam->judul_buku = $book->judul_buku;
            $pinjam->user = $pinjam->user()->first()->name;
            $pinjam->tanggal_text = \Carbon\Carbon::parse($pinjam->tanggal_peminjaman)->translatedFormat('d F Y');
            $pinjam->tanggal_sekarang = \Carbon\Carbon::now()->translatedFormat('d F Y');
        }
        return response()->json([
            'notifikasi' => $peminjaman,
        ]);
    }

    public function kembalikanBuku(Request $request){
        $request->validate([
            'id_peminjaman' => 'required|integer',
            'id_buku' => 'required|integer',
            'isbn' => 'required|string',
            'id_anggota' => 'required|integer',
            'status' => 'required|string',
            'denda' => 'nullable|integer',
            'tanggal_pengembalian' => 'required|date',
        ]);

        $peminjaman = Peminjaman::find($request->id_peminjaman);
        if (!$peminjaman) {
            return response()->json(['success' => false, 'message' => 'Peminjaman not found.']);
        }

        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
        $peminjaman->status_peminjaman = $request->status;
        $peminjaman->status = "selesai";
        if ($request->denda) {
            $peminjaman->denda = $request->denda;
        }
        $peminjaman->save();

        $buku = Buku::find($request->id_buku);
        $buku->jumlah_buku += 1; // Increment the book stock
        $buku->save();

        return response()->json(['success' => true, 'message' => 'Buku berhasil dikembalikan!']);
    }

    public function riwayat($user_id){
        $tanggal_sekarang = date('Y-m-d');
        $peminjaman = Peminjaman::where('user_id', $user_id)
                ->get();

        if ($peminjaman->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No data found.']);
        }
        foreach($peminjaman as $pinjam){
            $book = Buku::find($pinjam->buku_id); // Corrected to use $pinjam instead of $peminjaman
            $pinjam->file = asset('storage/' . $book->file);
            $pinjam->gambar = asset('storage/' . $book->gambar);
            $pinjam->id_buku = $book->id;
            $pinjam->penulis = $book->pengarang()->first()->nama_pengarang;
            $pinjam->kategori = $book->kategori()->first()->nama;
            $pinjam->isbn = $book->isbn;
            $pinjam->id_peminjaman = $pinjam->id;
            $pinjam->judul_buku = $book->judul_buku;
            $pinjam->user = $pinjam->user()->first()->name;
            $pinjam->tanggal_text = \Carbon\Carbon::parse($pinjam->tanggal_peminjaman)->translatedFormat('d F Y');
            $pinjam->tanggal_sekarang = \Carbon\Carbon::now()->translatedFormat('d F Y');
            $pinjam->sudah_review = $pinjam->review()->where('user_id', $user_id)->exists();
        }
        return response()->json([
            'books' => $peminjaman,
        ]);
    }

    public function review(Request $request){
        $request->validate([
            'id_buku' => 'required|integer',
            'id_peminjaman' => 'required|integer',
            'id_anggota' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:255',
        ]);

        $peminjaman = Peminjaman::find($request->id_peminjaman);
        if (!$peminjaman) {
            return response()->json(['success' => false, 'message' => 'Peminjaman not found.']);
        }

        // Save the review
        $review = Review::create([
            'buku_id' => $request->id_buku,
            'user_id' => $request->id_anggota,
            'rating' => $request->rating,
            'review' => $request->review,
            'peminjaman_id' => $request->id_peminjaman,
        ]);

        return response()->json(['success' => true, 'message' => 'Review berhasil ditambahkan!']);
    }
}
