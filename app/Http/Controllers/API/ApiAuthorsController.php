<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ApiAuthorStore;
use App\Http\Resources\AuthorsCollection;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ApiAuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return new AuthorsCollection($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiAuthorStore $request)
    {

        $validatedData = $request->validated();

        Author::create($validatedData);

        return response()->json([
            'message' => 'author created successfully'
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
        $author = Author::find($id);

        return $author;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiAuthorStore $request, $id)
    {

        $author = Author::findOrFail($id);
        $validatedData = $request->validated();

        $author->update($validatedData);

        return response()->json([
            'message' => 'author updated successfully'
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
        $author = Author::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Author deleted successfully'
        ]);

    }
}
