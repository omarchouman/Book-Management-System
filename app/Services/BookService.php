<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookService
{
    public function __construct(protected OpenAIService $openAI) {}

    public function search(string $search = null)
    {
        return Book::when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
    }

    public function store(array $data): Book
    {
        if (empty($data['description'])) {
            $data['description'] = $this->openAI->generateBookDescription(
                $data['title'],
                $data['author']
            );
        }

        if (empty($data['tags'])) {
            $data['tags'] = $this->openAI->generateBookTags(
                $data['title'],
                $data['description']
            );
        }

        return Book::create($data);
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);
        return $book;
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }

    public function checkOut(Book $book): void
    {
        $book->update(['is_checked_out' => true]);
    }

    public function checkIn(Book $book): void
    {
        $book->update(['is_checked_out' => false]);
    }
}
