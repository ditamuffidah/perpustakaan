<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'penerbit';

    // Menambahkan nama_penerbit ke dalam properti fillable
    protected $fillable = [
        'nama_penerbit',
    ];
}
