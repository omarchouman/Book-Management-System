<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function __construct(protected BookService $bookService) {}

    public function index(Request $request)
    {
        $books = $this->bookService->search($request->input('search'));
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $this->bookService->store($request->validated());
        return redirect()->route('books.index')->with('success', 'Book added!');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->bookService->update($book, $request->validated());
        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function destroy(Book $book)
    {
        $this->bookService->delete($book);
        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }

    public function checkOut(Book $book)
    {
        $this->bookService->checkOut($book);
        return back()->with('success', 'Book checked out!');
    }

    public function checkIn(Book $book)
    {
        $this->bookService->checkIn($book);
        return back()->with('success', 'Book checked in!');
    }
}
