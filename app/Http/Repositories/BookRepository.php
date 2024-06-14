<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\BookRepositoryInterface;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    public function create(string $name, string $description, int $count)
    {
        Book::create([
            'name' => $name,
            'description' => $description,
            'count' => $count
        ]);
    }

    public function searchWithName(string $name)
    {
        return Book::where('name', 'LIKE', "%{$name}%")->paginate(10);
    }

    public function getAll()
    {
        return Book::paginate(10);
    }

    public function countAllAvailableBooks(int $id)
    {
        return Book::find($id)->count - Book::find($id)->borrows()->whereNull('end_date')->count();
    }

    public function findAllBorrowsForBook(int $id)
    {
        return Book::find($id)->borrows()->paginate(5);
    }

    public function findWithId(int $id)
    {
        return Book::find($id);
    }

    public function edit(int $id, string $name, string $description)
    {
        $book = Book::find($id);
        
        $book->name = $name;
        $book->description = $description;

        $book->save();
    }
}