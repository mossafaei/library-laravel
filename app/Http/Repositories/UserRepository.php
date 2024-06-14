<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function checkUserHasBook(string $email, int $bookID) : bool
    {
        $count = User::where('email', '=', $email)->first()->borrows()->where('book_id', '=', $bookID)->whereNull('end_date')->count();
        return ($count === 0);
    }

    public function create(string $name, string $email, string $password, string $address, string $phoneNumber)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'address' => $address,
            'phone_number' => $phoneNumber
        ]);
    }

    public function findWithEmail(string $email)
    {
        return User::where('email', '=', $email)->first()->id;
    }

    public function searchWithEmail(string $email)
    {
        return User::where('email', 'LIKE', "%{$email}%")->paginate(10);
    }

    public function findAll()
    {
        return User::paginate(10);
    }

    public function findWithId(int $id)
    {
        return User::find($id);
    }

    public function findAllPendingBorrows(int $id)
    {
        return User::find($id)->borrows()->whereNull('end_date')->paginate(5);
    }

    public function edit(int $id, string $name, string $email, string $address, string $phoneNumber)
    {
        $user = User::find($id);
        
        $user->name = $name;
        $user->email = $email;
        $user->address = $address;
        $user->phone_number = $phoneNumber;

        $user->save();
    }
}