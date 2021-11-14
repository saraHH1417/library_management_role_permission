<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{

    public function __construct()
    {
//        $this->middleware('permission:publisher-list|publisher-create|publisher-edit|publisher-delete', ['only' => ['index', 'show']]);
//        $this->middleware('permission:publisher-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:publisher-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:publisher-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Publisher::latest()->get();

        return view('publishers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $input = $request->except(['_token']);

        $publisher = Publisher::create($input);

        return redirect()->route('publishers.show', ['publisher' => $publisher->id])
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publisher = Publisher::findOrFail($id);

        return view('publishers.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);

        return view('publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $publisher = Publisher::find($id);

        $publisher->update($request->all());

        return redirect()->route('publishers.index')
            ->with('success', 'publisher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Publisher::findOrFail($id)->delete();

        return redirect()->route('publishers.index')
            ->with('success', 'publisher deleted successfully.');
    }
}



