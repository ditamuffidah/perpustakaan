<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     // Konstruktor untuk middleware autentikasi
    //  public function __construct()
    //  {
    //      $this->middleware('auth:sanctum'); // Menggunakan middleware Sanctum
    //  }
 
     // Menampilkan daftar buku
     public function index()
     {
         $books = Buku::all(); // Ambil semua data buku
        //  ubah kolom file, dengan menambahkan asset('storage'.)
         foreach ($books as $book) {
             $book->file = asset('storage/' . $book->file);
             $book->gambar = asset('storage/' . $book->gambar);
             $book->penulis = $book->pengarang()->first()->nama_pengarang;
             $book->kategori = $book->kategori()->first()->nama;
         }
         return response()->json($books); // Kembalikan sebagai JSON
     }

     public function buku_category(){
        $books = Buku::all(); // Ambil semua data buku
        //  ubah kolom file, dengan menambahkan asset('storage'.)
         foreach ($books as $book) {
             $book->file = asset('storage/' . $book->file);
             $book->gambar = asset('storage/' . $book->gambar);
             $book->penulis = $book->pengarang()->first()->nama_pengarang;
             $book->kategori = $book->kategori()->first()->nama;
         }
        $categories = Kategori::all();
        return response()->json([
            'books' => $books,
            'category' => $categories
        ]);
     }
     public function buku_filter_category($category){
        $category = Kategori::where('nama','=',$category)->first();
        // dd($category);
        $books = Buku::where('id_kategori','=',$category->id)->get();
         foreach ($books as $book) {
             $book->file = asset('storage/' . $book->file);
             $book->gambar = asset('storage/' . $book->gambar);
             $book->penulis = $book->pengarang()->first()->nama_pengarang;
             $book->kategori = $book->kategori()->first()->nama;
         }
        return response()->json([
            'books' => $books,
        ]);
     }

     public function buku_detail($id){
        $book = Buku::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $book->file = asset('storage/' . $book->file);
        $book->gambar = asset('storage/' . $book->gambar);
        $book->penulis = $book->pengarang()->first()->nama_pengarang;
        $book->kategori = $book->kategori()->first()->nama;
        $book->review = Review::where('buku_id',$book->id)->leftJoin('users', 'reviews.user_id', '=', 'users.id')->
        select('reviews.*', 'users.name')->get();
        
        return response()->json($book); // Return the book details as JSON
     }

     public function buku_tersedia(){
        $books = Buku::where('jumlah_buku','>',0)->get();
        //  ubah kolom file, dengan menambahkan asset('storage'.)
         foreach ($books as $book) {
             $book->file = asset('storage/' . $book->file);
             $book->gambar = asset('storage/' . $book->gambar);
             $book->penulis = $book->pengarang()->first()->nama_pengarang;
             $book->kategori = $book->kategori()->first()->nama;
         }
        return response()->json([
            'books' => $books,
        ]);
     }

     public function buku_ebook(){
        $books = Buku::where('file','!=',null)->get();
         foreach ($books as $book) {
             $book->file = asset('storage/' . $book->file);
             $book->gambar = asset('storage/' . $book->gambar);
             $book->penulis = $book->pengarang()->first()->nama_pengarang;
             $book->kategori = $book->kategori()->first()->nama;
         }
         $categories = Kategori::all();
         return response()->json([
             'books' => $books,
             'category' => $categories
         ]);
     }

     public function update_profile(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::find($request->id_user);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);
    }

}
