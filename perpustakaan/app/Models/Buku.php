<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'buku';

    // Menentukan bahwa 'id_buku' adalah primary key
    protected $primaryKey = 'id_buku';
    public $incrementing = false; // Jika 'id_buku' bukan auto-increment
    protected $keyType = 'string'; // Jika 'id_buku' bertipe string (seperti kode atau UUID)

    // Daftar kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_buku',
        'kd_buku',
        'id_klarifikasi',
        'id_pengarang',
        'judul_buku',
        'id_penerbit',
        'kolasi',
        'keterangan',
        'jdl_seri',
        'isbn',
        'id_subject',
        'jumlah_buku',
        'id_rak',
        'id_kategori',
        'tahun',
        'asal',
        'file',
        'edisi',
        'abstraksi',
        'bahasa',
        'biblio',
        'kota',
        'ket_sama',
        'gambar'
    ];

    /**
     * Relasi ke tabel 'kategori'
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    /**
     * Relasi ke tabel 'klarifikasi'
     */
    public function klarifikasi()
    {
        return $this->belongsTo(Klarifikasi::class, 'id_klarifikasi');
    }

    /**
     * Relasi ke tabel 'pengarang'
     */
    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class,'id_pengarang');
    }

    /**
     * Relasi ke tabel 'penerbit'
     */
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }

    /**
     * Relasi ke tabel 'subject'
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'id_subject');
    }

    /**
     * Relasi ke tabel 'rak'
     */
    public function rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak');
    }

    // peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    // review
    public function reviews()
    {
        return $this->hasMany(Review::class, 'buku_id');
    }

    
}
