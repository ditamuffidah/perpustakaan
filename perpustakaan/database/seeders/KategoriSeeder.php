<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['id' => 1, 'nama' => 'Umum'],
            ['id' => 2, 'nama' => 'Filsafat'],
            ['id' => 3, 'nama' => 'Agama'],
            ['id' => 4, 'nama' => 'Sosial'],
            ['id' => 5, 'nama' => 'Bahasa'],
            ['id' => 6, 'nama' => 'Sains'],
            ['id' => 7, 'nama' => 'Teknologi'],
            ['id' => 8, 'nama' => 'Seni'],
            ['id' => 9, 'nama' => 'Sastra'],
            ['id' => 10, 'nama' => 'Sejarah'],
        ]);
    }
}
