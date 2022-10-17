<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        //Create user account

        //Create customer instance

        //Create wallet instance

        //Send activation email

        //Send SMS

        //Retrun success message

        //Write test



    }

    public function forgotpassword() {

        $data['title'] = "Forgot Password";
        return view('template.auth.forgotpassword', $data);
    }
}
