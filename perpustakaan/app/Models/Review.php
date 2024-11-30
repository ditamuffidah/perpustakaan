<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // guarded
    protected $guarded = [];

    // peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    // buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    // user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
