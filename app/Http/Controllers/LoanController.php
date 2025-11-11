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
    public function index()
    {
        $loans = Loan::with(['book', 'member'])->paginate(10);
        return view('Manajemen.Peminjaman', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        $members = Member::where('status', 'active')->get();
        return view('Manajemen.Peminjaman', compact('books', 'members'));
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
        return view('Manajemen.Peminjaman', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $books = Book::all();
        $members = Member::all();
        return view('Manajemen.Peminjaman', compact('loan', 'books', 'members'));
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

        $loan->update([
            'return_date' => $request->return_date,
            'fine' => $request->fine ?? 0,
            'status' => 'returned',
            'notes' => $request->notes,
        ]);

        // Increase book stock
        $loan->book->increment('stock');

        return redirect()->route('returns.index')->with('success', 'Book returned successfully.');
    }
}
