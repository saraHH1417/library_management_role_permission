<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ApiStorePublisher;
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
    public function store(ApiStorePublisher $request)
    {
        $validatedData = $request->validated();

        $publisher = Publisher::create($validatedData);

        return response()->json([
            'message' => 'Publisher created successfully'
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
    public function update(ApiStorePublisher $request, $id)
    {

        $publisher = Publisher::findOrFail($id);
        $validatedData = $request->validated();

        $publisher->update($validatedData);

        return response()->json([
            'message' => 'Publisher updated successfully'
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
