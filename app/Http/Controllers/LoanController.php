<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Loan::with(['book', 'member']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('book', function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%");
            })->orWhereHas('member', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $loans = $query->paginate(10);
        return view('Manajemen.Peminjaman', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        $members = Member::where('status', 'active')->get();
        return view('Manajemen.loan_create', compact('books', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'loan_date' => 'required|date|before_or_equal:today',
            'due_date' => 'required|date|after:loan_date',
            'notes' => 'nullable|string',
        ]);

        $book = Book::find($request->book_id);
        $member = Member::find($request->member_id);

        // Check if book is available
        if ($book->stock <= 0) {
            return back()->with('error', 'Book is not available for loan.');
        }

        // Check if member has active loans
        $activeLoans = $member->loans()->where('status', 'active')->count();
        if ($activeLoans >= 3) { // Assuming max 3 books per member
            return back()->with('error', 'Member has reached maximum loan limit.');
        }

        $loan = Loan::create($request->all());

        // Decrease book stock
        $book->decrement('stock');

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        return view('Manajemen.loan_show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $books = Book::all();
        $members = Member::all();
        return view('Manajemen.loan_edit', compact('loan', 'books', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'loan_date' => 'required|date|before_or_equal:today',
            'due_date' => 'required|date|after:loan_date',
            'notes' => 'nullable|string',
        ]);

        $loan->update($request->all());

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        // If loan is active, return the book stock
        if ($loan->status === 'active') {
            $loan->book->increment('stock');
        }

        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }

    /**
     * Return a book (for Pengembalian management).
     */
    public function returnBook(Request $request, Loan $loan)
    {
        $request->validate([
            'return_date' => 'required|date|after_or_equal:' . $loan->loan_date,
            'fine' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Calculate fine based on return date vs due date
        $returnDate = \Carbon\Carbon::parse($request->return_date);
        $dueDate = $loan->due_date;

        $fine = 0;
        if ($returnDate->isAfter($dueDate)) {
            $daysLate = $returnDate->diffInDays($dueDate);
            $fine = $daysLate * 5000; // Rp 5,000 per day
        }

        // Override with manual fine if provided
        if ($request->filled('fine')) {
            $fine = $request->fine;
        }

        $loan->update([
            'return_date' => $request->return_date,
            'fine' => $fine,
            'status' => 'returned',
            'notes' => $request->notes,
        ]);

        // Increase book stock
        $loan->book->increment('stock');

        $message = "Buku '{$loan->book->title}' telah berhasil dikembalikan.";
        if ($fine > 0) {
            $message .= " Anda dikenakan denda keterlambatan sebesar Rp " . number_format($fine, 0, ',', '.');
        }

        // Create notification for the user
        \App\Models\Notification::create([
            'user_id' => $loan->member->user_id,
            'type' => 'book_return',
            'title' => 'Buku Telah Dikembalikan',
            'message' => $message,
            'data' => [
                'loan_id' => $loan->id,
                'book_id' => $loan->book->id,
            ],
        ]);

        return redirect()->route('Manajemen/Pengembalian')->with('success', 'Book returned successfully.');
    }

    /**
     * Show form for mahasiswa to create loan request
     */
    public function createRequest()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('Manajemen.loan_request', compact('books'));
    }

    /**
     * Store loan request from mahasiswa
     */
    public function storeRequest(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date|after_or_equal:today',
            'due_date' => 'required|date|after:loan_date',
            'notes' => 'nullable|string',
        ]);

        $user = auth()->user();

        // Check if user has completed member registration
        if (!$user->member || !$user->member->isProfileComplete()) {
            return redirect()->route('member.registration')->with('error', 'Silakan lengkapi data anggota terlebih dahulu sebelum mengajukan peminjaman buku.');
        }

        $book = Book::find($request->book_id);

        // Check if book is available
        if ($book->stock <= 0) {
            return back()->with('error', 'Book is not available for loan.');
        }

        $memberId = $user->member->id;

        // Check if member has active loans or pending requests
        $activeLoans = Member::find($memberId)->loans()->whereIn('status', ['approved', 'pending'])->count();
        if ($activeLoans >= 3) { // Assuming max 3 books per member
            return back()->with('error', 'You have reached maximum loan limit.');
        }

        $loan = Loan::create([
            'book_id' => $request->book_id,
            'member_id' => $memberId,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => 'pending', // New loans start as pending
            'notes' => $request->notes,
        ]);

        // Create notification for the user
        \App\Models\Notification::create([
            'user_id' => $user->id,
            'type' => 'loan_pending',
            'title' => 'Permintaan Peminjaman Terkirim',
            'message' => "Permintaan peminjaman buku '{$book->title}' telah terkirim dan sedang menunggu persetujuan.",
            'data' => [
                'loan_id' => $loan->id,
                'book_id' => $book->id,
            ],
        ]);

        // Create notification for admin/staff
        $adminUsers = \App\Models\User::whereIn('role', ['admin', 'staff'])->get();

        foreach ($adminUsers as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'type' => 'loan',
                'title' => 'Permintaan Peminjaman Buku Baru',
                'message' => "Mahasiswa {$user->name} mengajukan permintaan peminjaman buku '{$book->title}' pada tanggal " . Carbon::parse($request->loan_date)->format('d/m/Y'),
                'data' => [
                    'loan_id' => $loan->id,
                    'requester_id' => $user->id,
                    'book_id' => $book->id,
                ],
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Loan request submitted successfully. Please wait for approval.');
    }

    /**
     * Approve loan request (Admin/Staff only)
     */
    public function approveLoan(Request $request, Loan $loan)
    {
        if (!$loan->isPending()) {
            return back()->with('error', 'This loan is not pending approval.');
        }

        $loan->update(['status' => 'approved']);

        // Decrease book stock
        $loan->book->decrement('stock');

        $message = "Permintaan peminjaman buku '{$loan->book->title}' telah disetujui. Silakan ambil buku di perpustakaan.";
        if ($request->filled('notes')) {
            $message .= " Catatan: " . $request->notes;
        }

        // Create notification for the mahasiswa
        \App\Models\Notification::create([
            'user_id' => $loan->member->user_id,
            'type' => 'loan_approved',
            'title' => 'Permintaan Peminjaman Disetujui',
            'message' => $message,
            'data' => [
                'loan_id' => $loan->id,
                'book_id' => $loan->book->id,
                'approved_by' => auth()->id(),
            ],
        ]);

        return back()->with('success', 'Loan request approved successfully.');
    }

    /**
     * Reject loan request (Admin/Staff only)
     */
    public function rejectLoan(Request $request, Loan $loan)
    {
        if (!$loan->isPending()) {
            return back()->with('error', 'This loan is not pending approval.');
        }

        $loan->update(['status' => 'rejected']);

        $message = "Maaf, permintaan peminjaman buku '{$loan->book->title}' telah ditolak.";
        if ($request->filled('notes')) {
            $message .= " Alasan: " . $request->notes;
        }

        // Create notification for the mahasiswa
        \App\Models\Notification::create([
            'user_id' => $loan->member->user_id,
            'type' => 'loan_rejected',
            'title' => 'Permintaan Peminjaman Ditolak',
            'message' => $message,
            'data' => [
                'loan_id' => $loan->id,
                'book_id' => $loan->book->id,
                'rejected_by' => auth()->id(),
            ],
        ]);

        return back()->with('success', 'Loan request rejected.');
    }


}
