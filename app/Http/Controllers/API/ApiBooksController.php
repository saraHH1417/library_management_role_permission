<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksCollection;
use App\Models\Book;
use Illuminate\Http\Request;

class ApiBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BooksCollection(Book::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(request()->all(), [
            'name'     => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'quantity' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        if(Book::create($validator->validated())){
            return response()->json([
                'message' => 'book created successfully'
            ]);
        }else {
            return response()->json([
                'message' => 'error'
            ]);
        }
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
        if($book){
            return $book;
        }else {
            return response()->json([
                'message' => "book doesn't exist"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(request()->all(), [
            'name'     => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'quantity' => 'required'
        ]);
        $book = Book::findOrFail($id);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        if($book->update($validator->validated())){
            return response()->json([
                'message' => 'book updated successfully'
            ]);
        }else {
            return response()->json([
                'message' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book) {
            if ($book->delete()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Book deleted successfully'
                ]);
            }else{
                return response()->json([
                    'message' => 'an error has occurred'
                ]);
            }
        }else{
            return response()->json([
                'message' => 'book not found'
            ]);
        }
    }
}
