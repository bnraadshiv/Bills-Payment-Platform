<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function forgotpassword() {

        $data['title'] = "Forgot Password";
        return view('template.auth.forgotpassword', $data);
    }
}
