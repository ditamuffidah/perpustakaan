<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        DB::table('subject')->insert([
            ['name' => 'Matematika'],
            ['name' => 'Fisika'],
            ['name' => 'Kimia'],
        ]);
    }
}
