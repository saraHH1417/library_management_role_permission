<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ApiStoreBook;
use App\Http\Requests\StoreBook;
use App\Http\Resources\BooksCollection;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return new BooksCollection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiStoreBook $request)
    {
        $validatedData = $request->validated();
        Book::create($validatedData);

        return response()->json([
            'message' => 'book created successfully'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        return response()->json([
            'message' => "book doesn't exist"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiStoreBook $request, $id)
    {

        $book = Book::findOrFail($id);
        $validatedData = $request->validated();
        $book->update($validatedData);

        return response()->json([
            'message' => 'book created successfully'
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Book deleted successfully'
        ]);
    }
}
