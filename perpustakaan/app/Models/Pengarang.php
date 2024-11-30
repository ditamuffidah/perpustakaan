<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;

    // Tentukan nama tabel (opsional jika menggunakan konvensi Laravel)
    protected $table = 'pengarang';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'nama_pengarang',
        'biografi'
    ];

    // Relasi ke model Buku (One to Many)
    public function bukus()
    {
        return $this->hasMany(Buku::class,'pengarang_id');
    }
}
