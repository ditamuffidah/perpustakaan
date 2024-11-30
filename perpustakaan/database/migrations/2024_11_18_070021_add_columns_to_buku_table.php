<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBukuTable extends Migration
{
    public function up()
    {
        Schema::table('buku', function (Blueprint $table) {
            // Menambah kolom hanya jika belum ada
            if (!Schema::hasColumn('buku', 'id_buku')) {
                $table->string('id_buku')->nullable();
            }
            if (!Schema::hasColumn('buku', 'kd_buku')) {
                $table->string('kd_buku')->nullable();
            }
            if (!Schema::hasColumn('buku', 'id_klarifikasi')) {
                $table->integer('id_klarifikasi')->nullable();
            }
            if (!Schema::hasColumn('buku', 'id_pengarang')) {
                $table->integer('id_pengarang')->nullable();
            }
            if (!Schema::hasColumn('buku', 'judul_buku')) {
                $table->string('judul_buku')->nullable();
            }
            if (!Schema::hasColumn('buku', 'id_penerbit')) {
                $table->integer('id_penerbit')->nullable();
            }
            if (!Schema::hasColumn('buku', 'kolasi')) {
                $table->string('kolasi')->nullable();
            }
            if (!Schema::hasColumn('buku', 'keterangan')) {
                $table->text('keterangan')->nullable();
            }
            if (!Schema::hasColumn('buku', 'jdl_seri')) {
                $table->string('jdl_seri')->nullable();
            }
            if (!Schema::hasColumn('buku', 'isbn')) {
                $table->string('isbn')->nullable();
            }
            if (!Schema::hasColumn('buku', 'id_subject')) {
                $table->integer('id_subject')->nullable();
            }
            if (!Schema::hasColumn('buku', 'jumlah_buku')) {
                $table->integer('jumlah_buku')->nullable();
            }
            if (!Schema::hasColumn('buku', 'id_rak')) {
                $table->integer('id_rak')->nullable();
            }
            if (!Schema::hasColumn('buku', 'id_kategori')) {
                $table->integer('id_kategori')->nullable();
            }
            if (!Schema::hasColumn('buku', 'tahun')) {
                $table->integer('tahun')->nullable();
            }
            if (!Schema::hasColumn('buku', 'asal')) {
                $table->string('asal')->nullable();
            }
            if (!Schema::hasColumn('buku', 'file')) {
                $table->string('file')->nullable();
            }
            if (!Schema::hasColumn('buku', 'edisi')) {
                $table->string('edisi')->nullable();
            }
            if (!Schema::hasColumn('buku', 'abstraksi')) {
                $table->text('abstraksi')->nullable();
            }
            if (!Schema::hasColumn('buku', 'bahasa')) {
                $table->string('bahasa')->nullable();
            }
            if (!Schema::hasColumn('buku', 'biblio')) {
                $table->string('biblio')->nullable();
            }
            if (!Schema::hasColumn('buku', 'kota')) {
                $table->string('kota')->nullable();
            }
            if (!Schema::hasColumn('buku', 'ket_sama')) {
                $table->string('ket_sama')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn([
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
                'ket_sama'
            ]);
        });
    }
}

