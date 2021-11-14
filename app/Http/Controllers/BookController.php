<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class BookController extends Controller
{

    public function __construct()
    {
//        $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index', 'show']]);
//        $this->middleware('permission:book-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:book-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::latest()->get();
        return view('books.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = \App\Models\Author::all();
        $publishers = Publisher::all();
        return view('books.create' , ['authors' => $authors , 'publishers' => $publishers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'author_id'=> 'required',
            'publisher_id'=> 'required',
            'quantity' => 'required'
        ]);
        $input = $request->except(['_token']);

        $book = Book::create($input);

        return redirect()->route('books.show' , ['book' => $book->id])
            ->with('success','Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with('author' , 'publisher')->findOrFail($id);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = \App\Models\Author::all();
        $publishers = Publisher::all();
        return view('books.edit',compact('book') ,['authors' => $authors , 'publishers' => $publishers]);
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
        $this->validate($request, [
            'name' => 'required',
            'author_id'=> 'required',
            'publisher_id'=> 'required',
            'quantity' => 'required'
        ]);

        $book = Book::find($id);

        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}

