<?php

namespace App\Providers;

use App\Http\Repositories\BookRepository;
use App\Http\Repositories\BorrowRepository;
use App\Http\Repositories\Interfaces\BookRepositoryInterface;
use App\Http\Repositories\Interfaces\BorrowRepositoryInterface;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(BorrowRepositoryInterface::class, BorrowRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
