<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    //

    public function register() {



        $users = User::all();
        $no_of_users = $users->count();

        $data = [
            'users' => $users,
            'no_of_users' => $no_of_users, 
        ];



        return view('/register', $data);
    }

    public function registerAction(Request $request) {

        //dd($request->all());

        //$user = User::create($request->all());

        //OR
        //$user = User::create($request->only('name', 'email', 'password'));

        //OR
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->name = $request->name;
        // $user->save();

        //OR
        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),

        ]);

        return redirect()->back()->with('success', 'User was created successfully');


    }




}
