<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            // Buat permissions
            $permissions = [
                // Permissions untuk surat pengantar
                'manage_surat_pengantar',
                'view_surat_pengantar',

                // Permissions untuk jenis layanan
                'manage_jenis_layanan',
                'view_jenis_layanan',

                // Permissions untuk pengaduan
                'manage_pengaduan',
                'view_pengaduan',

                // Permissions untuk profile
                'view_profile',
                'edit_profile',
            ];

            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }

            // Buat role admin
            $adminRole = Role::firstOrCreate(['name' => 'admin']);
            // Assign semua permissions ke role admin
            $adminRole->givePermissionTo(Permission::all());

            // Buat role user
            $userRole = Role::firstOrCreate(['name' => 'user']);
            // Assign permissions yang relevan ke role user
            $userRole->givePermissionTo([
                'view_surat_pengantar',
                'view_jenis_layanan',
                'view_pengaduan',
                'view_profile',
            ]);

            // Assign role admin ke user dengan ID 1
            $user = User::find(1); // Ganti dengan ID pengguna yang ingin Anda ubah
            if ($user) {
                $user->assignRole('admin');
            }
            $user = User::find(9); // Ganti dengan ID pengguna yang ingin Anda ubah
            if ($user) {
                $user->assignRole('user');
            }
        });
    }
}
