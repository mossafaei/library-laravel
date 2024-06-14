<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\BorrowRepositoryInterface;
use App\Models\Borrow;

class BorrowRepository implements BorrowRepositoryInterface
{
    public function create(int $managerId, int $userId, int $bookId)
    {
        Borrow::create([
            'manager_id' => $managerId,
            'user_id' => $userId,
            'book_id' => $bookId
        ]);
    }
    public function updateTimestamp(int $bookId, int $userId, $timestamp)
    {
        $borrow = Borrow::where([
            ['book_id', '=', $bookId], 
            ['user_id', '=', $userId], 
        ])->whereNull('end_date');
        $borrow->update(['end_date' => $timestamp]);
        
    }
}