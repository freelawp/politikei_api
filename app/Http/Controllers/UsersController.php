<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    public function getIndex()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function create()
    {
        //echo "olar";
        return "heyhooo";//view("user.create");
    }

    public function store()
    {
        $user = new User();
        $user->name = Imput::post("name");
        $user->email = Imput::post("email");
        $user->password = Imput::post("password");

        $user->save();
    }

    public function FunctionName($value='')
    {
        # code...
    }
}
