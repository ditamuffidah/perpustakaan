<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlarifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klarifikasis', function (Blueprint $table) {
            $table->id();  // Kolom ID yang otomatis ditambahkan oleh Laravel
            $table->string('nama');  // Kolom nama untuk klarifikasi
            $table->timestamps();  // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klarifikasis');
    }
}
