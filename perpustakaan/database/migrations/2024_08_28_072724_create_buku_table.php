<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->string('id_buku')->primary(); // Menambahkan id_buku sebagai primary key
            $table->string('kd_buku');
            $table->integer('id_klarifikasi');
            $table->integer('id_pengarang');
            $table->string('judul_buku');
            $table->integer('id_penerbit');
            $table->string('kolasi');
            $table->text('keterangan');
            $table->string('jdl_seri');
            $table->string('isbn');
            $table->integer('id_subject');
            $table->integer('jumlah_buku');
            $table->integer('id_rak');
            $table->integer('id_kategori');
            $table->year('tahun');
            $table->string('asal');
            $table->string('file');
            $table->string('edisi');
            $table->text('abstraksi');
            $table->string('bahasa');
            $table->string('biblio');
            $table->string('kota');
            $table->string('ket_sama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
