<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublishersCollection;
use App\Models\Publisher;
use Illuminate\Http\Request;

class ApiPublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PublishersCollection(Publisher::all());
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
            'name'     => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        if(Publisher::create($validator->validated())){
            return response()->json([
                'message' => 'publisher created successfully'
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
        $publisher = Publisher::find($id);
        if($publisher){
            return $publisher;
        }else {
            return response()->json([
                'message' => "publisher doesn't exist"
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
        $publisher = Publisher::findOrFail($id);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        if($publisher->update($validator->validated())){
            return response()->json([
                'message' => 'publisher updated successfully'
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
        $publisher = Publisher::find($id);
        if($publisher) {
            if ($publisher->delete()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Publisher deleted successfully'
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
