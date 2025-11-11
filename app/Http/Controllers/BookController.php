<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhere('isbn', 'LIKE', "%{$search}%")
                  ->orWhereHas('category', function($categoryQuery) use ($search) {
                      $categoryQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        $books = $query->paginate(10);
        $categories = Category::all(); // For filter dropdown

        return view('Manajemen.Buku', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Manajemen.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('Manajemen.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('Manajemen.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
