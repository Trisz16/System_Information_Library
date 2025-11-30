<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

$app = require_once 'bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

$user = \App\Models\User::where('role', 'mahasiswa')->first();
if (!$user) {
    echo 'No mahasiswa user found' . PHP_EOL;
    exit;
}
echo 'User: ' . $user->name . ' (' . $user->email . ')' . PHP_EOL;

// Check if member exists
$member = $user->member;
if (!$member) {
    $member = \App\Models\Member::create([
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'phone' => '+6281234567890',
        'address' => 'Test Address',
        'date_of_birth' => '2000-01-01',
        'gender' => 'male',
        'status' => 'active',
        'membership_date' => now(),
    ]);
    echo 'Created member: ' . $member->name . PHP_EOL;
} else {
    echo 'Member exists: ' . $member->name . PHP_EOL;
}

// Get available book
$book = \App\Models\Book::where('stock', '>', 0)->first();
if (!$book) {
    echo 'No available book found' . PHP_EOL;
    exit;
}
echo 'Book: ' . $book->title . ' (Stock: ' . $book->stock . ')' . PHP_EOL;

// Create loan request
$loan = \App\Models\Loan::create([
    'book_id' => $book->id,
    'member_id' => $member->id,
    'loan_date' => now()->addDay(),
    'due_date' => now()->addDays(30),
    'status' => 'pending',
    'notes' => 'Test loan request from mahasiswa',
]);
echo 'Created loan request: ID ' . $loan->id . ' Status: ' . $loan->status . PHP_EOL;

// Create notifications for admin/staff
$adminUsers = \App\Models\User::whereIn('role', ['admin', 'staff'])->get();
foreach ($adminUsers as $admin) {
    $message = 'Mahasiswa ' . $user->name . ' mengajukan permintaan peminjaman buku ' . $book->title . ' pada tanggal ' . $loan->loan_date->format('d/m/Y');
    \App\Models\Notification::create([
        'user_id' => $admin->id,
        'type' => 'loan',
        'title' => 'Permintaan Peminjaman Buku Baru',
        'message' => $message,
        'data' => [
            'loan_id' => $loan->id,
            'requester_id' => $user->id,
            'book_id' => $book->id,
        ],
    ]);
    echo 'Created notification for ' . $admin->role . ': ' . $admin->name . PHP_EOL;
}

// Verify
$notificationCount = \App\Models\Notification::count();
echo 'Total notifications: ' . $notificationCount . PHP_EOL;
$pendingLoans = \App\Models\Loan::where('status', 'pending')->count();
echo 'Pending loans: ' . $pendingLoans . PHP_EOL;

echo 'Test completed successfully!' . PHP_EOL;
