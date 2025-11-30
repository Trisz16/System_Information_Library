<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update all users with role 'student' to 'mahasiswa'
        DB::table('users')->where('role', 'student')->update(['role' => 'mahasiswa']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back from 'mahasiswa' to 'student'
        DB::table('users')->where('role', 'mahasiswa')->update(['role' => 'student']);
    }
};
