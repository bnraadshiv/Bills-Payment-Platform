<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function login() {

        $data['title'] = "Login";
        return view('template.auth.login', $data);
    }

    public function register() {

        $data['title'] = "Register";
        return view('template.auth.register', $data);
    }

    public function registerAction(Request $request) {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|string|max:50|unique:users',
            'email' => 'required|string|max:50|unique:users',
            'password' => 'required|string|max:6|confirmed',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Run a few checks 

        //Create user account (Include role: Admin/Customer)
        
        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();



        if(!$user) {

            return redirect()->back()->withError($user)->withInput();
        }

        //Create customer instance (customer_type: regular)

        $customer = $user->customer()->create([

            'user_id' => $user->id,
            'cutsomer_type' => "regular"

        ]);

        //Create wallet instance
         $wallet = $customer->wallet()->create([

             'balance' => "0.6"
         ]);

        //Send activation email

        //Send SMS

        //Retrun success message

        //Admins

        //Write test



    }

    public function forgotpassword() {

        $data['title'] = "Forgot Password";
        return view('template.auth.forgotpassword', $data);
    }
}
