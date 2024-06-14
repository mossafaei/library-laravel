<?php

namespace App\Http\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function checkUserHasBook(string $email, int $bookID) : bool;
    public function create(string $name, string $email, string $password, string $address, string $phoneNumber);
    public function findWithEmail(string $email);
    public function searchWithEmail(string $email);
    public function findAll();
    public function findWithId(int $id);
    public function findAllPendingBorrows(int $id);
    public function edit(int $id, string $name, string $email, string $address, string $phoneNumber);
}