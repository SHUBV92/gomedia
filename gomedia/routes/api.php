<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List Books 
Route::get('/books', 'BooksController@index');

// List single Book
Route::get('/book/{id}', 'BooksController@show');

// Create a new Book
Route::post('/book', 'BooksController@store');

// Update a Book
Route::put('/book', 'BooksController@store');

// Delete a book
Route::delete('/book/{id}', 'BooksController@destroy');
