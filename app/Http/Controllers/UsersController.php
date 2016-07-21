<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function create()
    {
        return view("user.create");
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = $request->input("password");

        $user->save();
    }

    public function show(ShowUserRequest $request)
    {
        $user = new User();
        return $user->find($request->input('id') );
    }

    public function edit(EditUserRequest $request)
    {
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::find($request->input('id') );

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        //TODO: Fazer uma response pimpa com textos legais;
        return $user->save();
    }

}
