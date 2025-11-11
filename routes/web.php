<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

//Route Welcome
Route::get('/', function () {
    return view('welcome');
});

//ROUTE UTAMA
//Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

//Route Peminjaman
Route::get('/LaporanPeminjaman', function () {
    return view('LaporanPeminjaman');
})->name('LaporanPeminjaman');

//Route Manajemen
Route::get('/ManajemenBuku', function () {
    return view('Manajemen/Buku');
})->name('Manajemen/Buku');

Route::get('/ManajemenKategori', function () {
    return view('Manajemen/Kategori');
})->name('Manajemen/Kategori');

Route::get('/ManajemenAnggota', function () {
    return view('Manajemen/Anggota');
})->name('Manajemen/Anggota');

Route::get('/ManajemenPeminjaman', function () {
    return view('Manajemen/Peminjaman');
})->name('Manajemen/Peminjaman');

Route::get('/ManajemenPengembalian', function () {
    return view('Manajemen.Pengembalian');
})->name('Manajemen/Pengembalian');

Route::get('/ManajemenUser&Role', function () {
    return view('Manajemen/User&Role');
})->name('Manajemen/User&Role');

//Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/notification', [ProfileController::class, 'notification'])->name('profile.notification');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
