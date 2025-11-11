<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Buku permissions
            'view buku',
            'create buku',
            'edit buku',
            'delete buku',

            // Kategori permissions
            'view kategori',
            'create kategori',
            'edit kategori',
            'delete kategori',

            // Anggota permissions
            'view anggota',
            'create anggota',
            'edit anggota',
            'delete anggota',

            // Peminjaman permissions
            'view peminjaman',
            'create peminjaman',
            'edit peminjaman',
            'delete peminjaman',

            // Pengembalian permissions
            'view pengembalian',
            'create pengembalian',
            'edit pengembalian',
            'delete pengembalian',

            // User & Role permissions
            'view user',
            'create user',
            'edit user',
            'delete user',
            'manage roles',

            // Dashboard permissions
            'view dashboard',

            // Laporan permissions
            'view laporan peminjaman',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $staffRole = Role::firstOrCreate(['name' => 'staff']);
        $staffPermissions = [
            'view buku',
            'create buku',
            'edit buku',
            'delete buku',
            'view kategori',
            'create kategori',
            'edit kategori',
            'delete kategori',
            'view anggota',
            'view peminjaman',
            'create peminjaman',
            'edit peminjaman',
            'delete peminjaman',
            'view pengembalian',
            'create pengembalian',
            'edit pengembalian',
            'delete pengembalian',
            'view dashboard',
            'view laporan peminjaman',
        ];
        $staffRole->givePermissionTo($staffPermissions);

        $mahasiswaRole = Role::firstOrCreate(['name' => 'mahasiswa']);
        $mahasiswaPermissions = [
            'view buku',
            'view kategori',
            'view anggota',
            'edit anggota', // CRUD on profile only
            'create peminjaman', // Create request only
            'view dashboard',
        ];
        $mahasiswaRole->givePermissionTo($mahasiswaPermissions);
    }
}
