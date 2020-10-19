<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Books as BooksResource;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Books
        $books = Books::orderBy('created_at', 'desc') ->paginate(5);

        // Return collection of books as a resource
        return BooksResource::collection($books);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = $request ->isMethod('put') ? Books::findOrFail
        ($request -> book_id) : new Books;
        
        // $book->id = $request->input('books_id');
        $book->title = $request->input('title');
        $book->Author = $request->input('Author');

        if($book->save()) {
            return new BooksResource($book);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get book
        $book = Books::findOrfail($id);

        // Return single book as a resource
        return new BooksResource($book);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           // Get book
           $book = Books::findOrfail($id);

           if($book ->delete()){
           // Return single book as a resource
           return new BooksResource($book);
        }
    }
}
