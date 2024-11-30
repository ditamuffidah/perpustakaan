<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission Admin
        $adminPermissions = [
            'tambah_user',
            'edit_user',
            'hapus_user',
            'lihat_user',
        ];

        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Permission Guru - Siswa
        $guruPermissions = [
            'tambah_data',
            'edit_data',
            'hapus_data',
            'lihat_data',
        ];

        foreach ($guruPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Role Admin
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->syncPermissions($adminPermissions);

        // Role Guru
        $roleGuru = Role::firstOrCreate(['name' => 'guru']);
        $roleGuru->syncPermissions($guruPermissions);
    }
}
