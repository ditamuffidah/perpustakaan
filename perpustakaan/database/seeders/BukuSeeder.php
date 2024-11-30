<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Kategori;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kategori dengan id 1 dan 2 ada sebelum membuat data buku
        $kategori1 = Kategori::find(1);
        $kategori2 = Kategori::find(2);

        if ($kategori1 && $kategori2) {
            Buku::updateOrCreate(
                ['id_buku' => 1],
                [
                    'kd_buku' => 'B001',
                    'id_klarifikasi' => 1,
                    'id_pengarang' => 1,
                    'judul_buku' => 'Pemrograman Web Laravel',
                    'id_penerbit' => 1,
                    'kolasi' => '200 halaman',
                    'keterangan' => 'Buku panduan lengkap Laravel',
                    'jdl_seri' => 'Edisi Pertama',
                    'isbn' => '978-602-1234-567',
                    'id_subject' => 1,
                    'jumlah_buku' => 10,
                    'id_rak' => 1,
                    'id_kategori' => $kategori1->id,
                    'tahun' => 2023,
                    'asal' => 'Pembelian',
                    'file' => 'path/to/file.pdf',
                    'edisi' => '2nd Edition',
                    'abstraksi' => 'Buku ini membahas framework Laravel secara mendetail.',
                    'bahasa' => 'Indonesia',
                    'biblio' => 'Referensi dari berbagai sumber',
                    'kota' => 'Bandung',
                    'ket_sama' => 'Versi terbaru',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            Buku::updateOrCreate(
                ['id_buku' => 2],
                [
                    'kd_buku' => 'B002',
                    'id_klarifikasi' => 2,
                    'id_pengarang' => 2,
                    'judul_buku' => 'Belajar Vue.js',
                    'id_penerbit' => 2,
                    'kolasi' => '150 halaman',
                    'keterangan' => 'Panduan dasar Vue.js',
                    'jdl_seri' => 'Edisi Kedua',
                    'isbn' => '978-602-2345-678',
                    'id_subject' => 2,
                    'jumlah_buku' => 5,
                    'id_rak' => 2,
                    'id_kategori' => $kategori2->id,
                    'tahun' => 2024,
                    'asal' => 'Hadiah',
                    'file' => 'path/to/another_file.pdf',
                    'edisi' => '1st Edition',
                    'abstraksi' => 'Buku ini membahas konsep dasar Vue.js untuk pemula.',
                    'bahasa' => 'Inggris',
                    'biblio' => 'Referensi dari dokumentasi Vue.js',
                    'kota' => 'Jakarta',
                    'ket_sama' => 'Versi lama',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        } else {
            $this->command->error('Kategori dengan ID 1 atau 2 tidak ditemukan.');
        }
    }
}
