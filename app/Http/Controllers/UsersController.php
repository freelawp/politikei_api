<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUserRequest;

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
        echo "A que ponto chegaremos?";
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = $request->input("password");

        $user->save();
    }

    public function show(ShowUserRequest $request)
    {
        $find = $this->getUser($request->input('id') );
        return ($find == null)? new Response('User not found',204) : new Response($find, 200) ;
    }

    public function edit(EditUserRequest $request)
    {
        $find = $this->getUser($request->input('id') );
        return ($find == null)? new Response('User not found',204) : new Response($find, 200) ;
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::find($request->input('id') );

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        //TODO: Fazer uma response pimpa com textos legais;
        $save = $user->save();

        return ($save)? new Response('User updated',200) : new Response('Error on update user',500);
    }



    private function getUser(int $id)
    {
        $user = new User();
        return $user->find($id);
    }

}
