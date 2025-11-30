<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        // Create staff user
        User::create([
            'name' => 'Staff User',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'staff',
        ]);

        // Create mahasiswa user
        $mahasiswa = User::create([
            'name' => 'Mahasiswa User',
            'email' => 'mahasiswa@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'mahasiswa',
        ]);

        // Create member record for mahasiswa user
        \App\Models\Member::create([
            'user_id' => $mahasiswa->id,
            'name' => $mahasiswa->name,
            'email' => $mahasiswa->email,
            'phone' => '081234567890',
            'address' => 'Jl. Mahasiswa No. 123, Kota Universitas',
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
            'status' => 'active',
            'membership_date' => now(),
        ]);
    }
}
