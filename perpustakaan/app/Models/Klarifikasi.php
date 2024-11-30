<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klarifikasi extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan nama model
    protected $table = 'klarifikasi';

    // Jika tabel memiliki kolom tertentu, Anda bisa menambahkannya di sini
    protected $fillable = [
        // Masukkan nama kolom yang ingin Anda isi
    ];

    // Definisi relasi ke model Buku
    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_klarifikasi');
    }
}
