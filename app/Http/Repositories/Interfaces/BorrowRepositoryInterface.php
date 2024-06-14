<?php

namespace App\Http\Repositories\Interfaces;

interface BorrowRepositoryInterface
{
    public function create(int $managerId, int $userId, int $bookId);
    public function updateTimestamp(int $bookId, int $userId, $timestamp);
}