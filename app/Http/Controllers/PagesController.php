<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function dashboard() {


        $data['title'] = "Dashboard";
        $data['description'] = "<h2>Welcome to our dashboard</h2>";
        $data['user'] = auth()->user();
        return view('template.customer.dashboard', $data);
    }
}
