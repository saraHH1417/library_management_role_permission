<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
//        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['store']]);
//        $this->middleware('permission:user-create', ['only' => ['create','store']]);
//        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = User::orderBy('id' , 'desc')->get();
        return view('users.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name' , 'name');
        return view('users.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $validatedData = $request->validate();

//        $input = $request->all();
//        $input['password'] = Hash::make($input['password']);
//
//        $user = User::create($input);

        $user = User::create($validatedData);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.show' , ['user' , $user->id])
            ->with('success' , 'user created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name' , 'name')->all();
        $userRoles = $user->roles->pluck('name' , 'name')->all();

        return view('users.edit' , compact('user' , 'roles' , 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, $id)
    {
        $user = User::findOrFail($id);

//        $this->authorize($user);

        $validatedData = $request->validated();
//        $user->fill($validatedData);
//        $user->save();
        $user->update($validatedData);
        DB::table('model_has_roles')
            ->where('model_id' , $id)
            ->delete();

        $user = $user->syncRoles($request->input('roles'));

        return redirect()->route('users.show' , ['user' => $user->id])
            ->with('success' , 'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize($user);

        $user->delete();

        return redirect()->route('users.index')
            ->with('success' , 'user has been deleted');
    }
}
