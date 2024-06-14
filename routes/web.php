<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/add-book', function () {
    return view('add/addbook');
})->middleware('auth');

Route::get('/add-user', function () {
    return view('add/adduser');
})->middleware('auth');

Route::get('/user/{id?}', 'App\Http\Controllers\ManagerController@showUser')->middleware('auth');
Route::get('/book/{id?}', 'App\Http\Controllers\ManagerController@showBook')->middleware('auth');

Route::get('/user/edit/{id}', 'App\Http\Controllers\ManagerController@showEditUser')->middleware('auth');
Route::get('/book/edit/{id}', 'App\Http\Controllers\ManagerController@showEditBook')->middleware('auth');

Route::post('/user', 'App\Http\Controllers\ManagerController@addUser')->middleware('auth');
Route::post('/book', 'App\Http\Controllers\ManagerController@addBook')->middleware('auth');

Route::put('/user/{id}', 'App\Http\Controllers\ManagerController@editUser')->middleware('auth');
Route::put('/book/{id}', 'App\Http\Controllers\ManagerController@editBook')->middleware('auth');

Route::post('/lend', 'App\Http\Controllers\ManagerController@lend')->middleware('auth');
Route::post('/take', 'App\Http\Controllers\ManagerController@take')->middleware('auth');

Auth::routes();
