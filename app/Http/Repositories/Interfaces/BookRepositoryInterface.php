<?php

namespace App\Http\Repositories\Interfaces;

interface BookRepositoryInterface
{
    public function create(string $name, string $description, int $count);
    public function searchWithName(string $name);
    public function getAll();
    public function countAllAvailableBooks(int $id);
    public function findAllBorrowsForBook(int $id);
    public function findWithId(int $id);
    public function edit(int $id, string $name, string $description);
}