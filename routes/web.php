<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/notification',[ProfileController::class, 'notification'])->name('profile.notification');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/ManajemenBuku', function () {
        return view('ManajemenBuku');
    })->name('ManajemenBuku');

    Route::get('/LaporanPeminjaman', function () {
        return view('LaporanPeminjaman');
    })->name('LaporanPeminjaman');

    Route::get('/ManajemenKategori', function () {
        return view('ManajemenKategori');
    })->name('ManajemenKategori');

    Route::get('/ManajemenAnggota', function () {
        return view('ManajemenAnggota');
    })->name('ManajemenAnggota');

    Route::get('/ManajemenPeminjaman', function () {
        return view('ManajemenPeminjaman');
    })->name('ManajemenPeminjaman');

    Route::get('/ManajemenPengembalian', function () {
        return view('ManajemenPengembalian');
    })->name('ManajemenPengembalian');

    Route::get('/ManajemenUser&Role', function () {
        return view('ManajemenUser&Role');
    })->name('ManajemenUser&Role');
    
});

require __DIR__.'/auth.php';