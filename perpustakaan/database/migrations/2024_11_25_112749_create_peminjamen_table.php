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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            // user_id, buku_id, isbn, tanggal_peminjaman, lama_peminjaman, tanggal_pengembalian
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('buku_id');
            $table->string('isbn');
            $table->date('tanggal_peminjaman');
            $table->integer('lama_peminjaman');
            $table->date('tanggal_pengembalian');
            // status (dipinjam, selesai, ditolak)
            $table->string('status')->default('menunggu konfirmasi');
            // buat constrain 
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('buku_id')->references('id_buku')->on('buku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
