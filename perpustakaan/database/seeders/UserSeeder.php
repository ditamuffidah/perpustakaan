<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role jika belum ada
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'guru']);

        // Buat user admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'level' => 'admin',
        ]);
        // Beri role 'admin' pada user admin
        $admin->assignRole('admin');

        // Buat user guru
        $guru = User::create([
            'name' => 'guru',
            'email' => 'guru@gmail.com',
            'password' => bcrypt('12345678'),
            'level' => 'guru',
        ]);
        // Beri role 'guru' pada user guru
        $guru->assignRole('guru');
    }
}
