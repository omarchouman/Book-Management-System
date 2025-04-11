<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $books = $query->latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book added!');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }


    public function checkOut(Book $book)
    {
        $book->update(['is_checked_out' => true]);
        return back()->with('success', 'Book checked out!');
    }

    public function checkIn(Book $book)
    {
        $book->update(['is_checked_out' => false]);
        return back()->with('success', 'Book checked in!');
    }
}
