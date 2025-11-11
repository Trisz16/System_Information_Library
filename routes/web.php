<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route Welcome
Route::get('/', function () {
    return view('welcome');
});

//ROUTE UTAMA
//Route Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route Peminjaman
Route::get('/LaporanPeminjaman', function () {
    return view('LaporanPeminjaman');
})->name('LaporanPeminjaman');

//Route Manajemen
Route::middleware(['auth'])->group(function () {
    // Books
    Route::resource('books', BookController::class);
    Route::get('/ManajemenBuku', [BookController::class, 'index'])->name('Manajemen/Buku');

    // Categories
    Route::resource('categories', CategoryController::class);
    Route::get('/ManajemenKategori', [CategoryController::class, 'index'])->name('Manajemen/Kategori');

    // Members
    Route::resource('members', MemberController::class);
    Route::get('/ManajemenAnggota', [MemberController::class, 'index'])->name('Manajemen/Anggota');

    // Loans
    Route::resource('loans', LoanController::class);
    Route::get('/ManajemenPeminjaman', [LoanController::class, 'index'])->name('Manajemen/Peminjaman');
    Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');

    // Returns
    Route::get('/ManajemenPengembalian', function () {
        $returns = \App\Models\Loan::with(['book', 'member'])->where('status', 'returned')->paginate(10);
        return view('Manajemen.Pengembalian', compact('returns'));
    })->name('Manajemen/Pengembalian');

    // User & Role
    Route::get('/ManajemenUser&Role', function () {
        return view('Manajemen/User&Role');
    })->name('Manajemen/User&Role');
});

//Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/notification', [ProfileController::class, 'notification'])->name('profile.notification');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
