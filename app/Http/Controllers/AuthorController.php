<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\ApiAuthorStore;
use App\Http\Requests\AuthorStore;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{

    public function __construct()
    {
//        $this->middleware('permission:author-list|author-create|author-edit|author-delete', ['only' => ['index', 'show']]);
//        $this->middleware('permission:author-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:author-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:author-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Author::latest()->get();
        return view('authors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorStore $request)
    {
        $validatedData = $request->validated();

        $author = Author::create($validatedData);

        return redirect()->route('authors.show', ['author' => $author->id])
            ->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorStore $request, $id)
    {

        $author = Author::findOrFail($id);

        $validatedData = $request->validated();

        $author->update($validatedData);


        return redirect()->route('authors.index')
            ->with('success', 'author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::findOrFail($id)->delete();

        return redirect()->route('authors.index')
            ->with('success', 'author deleted successfully.');
    }
}


