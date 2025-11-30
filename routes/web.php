<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route Welcome
Route::get('/', function () {
    return view('welcome');
});

//ROUTE UTAMA
//Route Dashboard - General route for all authenticated users
Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified', 'member.registration'])->name('dashboard');

//Route Peminjaman (Laporan)
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/laporan-peminjaman', [ReportController::class, 'loans'])->name('reports.loans');
});

//Route Manajemen
Route::middleware(['auth'])->group(function () {
    // Books - Admin and Staff only
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::resource('books', BookController::class);
        Route::get('/ManajemenBuku', [BookController::class, 'index'])->name('Manajemen/Buku');
    });

    // Categories - Admin and Staff only
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::get('/ManajemenKategori', [CategoryController::class, 'index'])->name('Manajemen/Kategori');
    });

    // Members - Admin and Staff only
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::resource('members', MemberController::class);
        Route::get('/ManajemenAnggota', [MemberController::class, 'index'])->name('Manajemen/Anggota');
    });

    // Loans - Admin and Staff CRUD, Student can create requests
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::resource('loans', LoanController::class);
        Route::get('/ManajemenPeminjaman', [LoanController::class, 'index'])->name('Manajemen/Peminjaman');
        Route::post('/loans/{loan}/approve', [LoanController::class, 'approveLoan'])->name('loans.approve');
        Route::post('/loans/{loan}/reject', [LoanController::class, 'rejectLoan'])->name('loans.reject');
    });

    // Notification routes for all authenticated users
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark_all_read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notifications.clear_all');

    // Chat routes for all authenticated users
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{chat}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/start', [ChatController::class, 'startChat'])->name('chat.start');
    Route::post('/chat/{chat}/message', [ChatController::class, 'sendMessage'])->name('chat.message');
    Route::post('/chat/{chat}/close', [ChatController::class, 'closeChat'])->name('chat.close');
    Route::get('/chat/unread-count', [ChatController::class, 'getUnreadCount'])->name('chat.unread_count');

    // AI Assistant routes for mahasiswa only
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/ai-assistant', [ChatController::class, 'aiAssistant'])->name('chat.ai-assistant');
        Route::post('/ai-assistant/{chat}/question', [ChatController::class, 'sendQuestion'])->name('chat.send_question');
    });

    // Student loan requests and read-only access
    Route::middleware(['role:mahasiswa', 'member.registration'])->group(function () {
        Route::get('/request-loan', [LoanController::class, 'createRequest'])->name('loans.request');
        Route::post('/request-loan', [LoanController::class, 'storeRequest'])->name('loans.store_request');

        // Member profile management for mahasiswa
        Route::get('/member-profile/edit', [MemberController::class, 'editProfile'])->name('member.profile.edit');
        Route::put('/member-profile/update', [MemberController::class, 'updateProfile'])->name('member.profile.update');

        // Read-only access for mahasiswa
        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/members/{member}', [MemberController::class, 'show'])->name('members.show');
    });

    // Member registration routes (no middleware needed)
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/member-registration', function () {
            $user = auth()->user();
            if ($user && $user->role === 'mahasiswa') {
                $user->load('member'); // Ensure member relationship is loaded
                if ($user->member && $user->member->isProfileComplete()) {
                    return redirect()->route('dashboard')->with('info', 'Anda sudah terdaftar sebagai anggota.');
                }
            }
            // Clear any error messages when accessing the registration form directly
            session()->forget('error');
            return view('Manajemen.member_registration');
        })->name('member.registration');
        Route::post('/member-registration', [MemberController::class, 'storeMemberRegistration'])->name('member.registration.store');
        Route::get('/member-register', function () {
            return view('Manajemen.member_registration');
        })->name('member.register.create');
    });

    // Returns - Admin/Staff verification, Student can initiate
    Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::get('/ManajemenPengembalian', function () {
            $returns = \App\Models\Loan::with(['book', 'member'])->where('status', 'returned')->paginate(10);
            return view('Manajemen.Pengembalian', compact('returns'));
        })->name('Manajemen/Pengembalian');
        Route::get('/returns/{loan}', function (\App\Models\Loan $loan) {
            return view('Manajemen.return_show', compact('loan'));
        })->name('returns.show');
    });

    // Mahasiswa return initiation
    Route::middleware(['role:mahasiswa', 'member.registration'])->group(function () {
        Route::get('/returns/create/{loan}', function (\App\Models\Loan $loan) {
            return view('Manajemen.return_create', compact('loan'));
        })->name('returns.create');
    });

    // User & Role - Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/ManajemenUser&Role', [UserController::class, 'index'])->name('Manajemen/User&Role');
    });
});

//Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/notification', [ProfileController::class, 'notification'])->name('profile.notification');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
