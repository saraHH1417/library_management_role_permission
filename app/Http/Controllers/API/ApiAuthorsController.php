<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        return new AuthorsCollection(Author::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name'     => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        if(Author::create($validator->validated())){
            return response()->json([
                'message' => 'author created successfully'
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
        $author = Author::find($id);
        if($author){
            return $author;
        }else {
            return response()->json([
                'message' => "author doesn't exist"
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
            'name'     => 'required'
        ]);
        $author = Author::findOrFail($id);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        if($author->update($validator->validated())){
            return response()->json([
                'message' => 'author updated successfully'
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
        $author = Author::find($id);
        if($author) {
            if ($author = $author->delete()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Author deleted successfully'
                ]);
            }else{
                return response()->json([
                    'message' => 'an error has occurred'
                ]);
            }
        }else{
            return response()->json([
                'message' => 'publisher not found'
            ]);
        }
    }
}
