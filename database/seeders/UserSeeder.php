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
            'role' => 'admin',
        ]);

        // Create staff user
        User::create([
            'name' => 'Staff User',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Create student user
        User::create([
            'name' => 'Student User',
            'email' => 'mahasiswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
    }
}
