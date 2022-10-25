<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    public function profile() {

        $data['title'] = "Profile";
        $data['user'] = auth()->user();
        return view('template.customer.profile', $data);

    }


    public function updateProfile(Request $request) {

        $user = auth()->user();

        $validator = Validator::make($request->all(), [
        

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,' .$user->id, //The last param is the one you want to escape
            'phone_number' => 'required|unique:users,phone_number,' .$user->id,

        ]);

        if($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        //update user
        $user->update([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,

        ]);

        return redirect()->back()->with('success', 'Profile update successfully');
        
    }


    public function uploadImage(Request $request) {

        $user = auth()->user();

        $validator = Validator::make($request->all(), [

            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:10000',
        ]);

        if($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagename = $user->avatar ?? time() .'.' .$request->image->extension();

        //dd($imagename);

        $request->image->move(public_path('site-resources/avatar'), $imagename);

        $user->update([

            'avatar' => $imagename,
        ]);


        return redirect()->back()->with('success', 'Profile image updated successfully');
    }

    public function updatePassword(){

        $data['title'] = "Update Password";

        return view('template.customer.update-password', $data);
    }

    public function updatePasswordAction(Request $request) {

        $validator = Validator::make($request->all(), [

            'old_password' =>'required',
            'new_password' =>'required|min:6|confirmed',
        ]);

        if($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        //Compare old pasword in DB

        if (!Hash::check($request->old_password, $user->password)) {

            return redirect()->back()->withErrors('Old Password is Incorrect');
        }

        $newpassword = Hash::make($request->new_password);

        $user->update([

            'password' => $newpassword,
        ]);

        return redirect()->back()->with('success', 'Password update successfully');

    }


    public function createCustomerPin(){

        $data['user'] = auth()->user();
        $data['title'] = "Pin Setup";


        return view('template.customer.pin', $data);
    }

    public function createPinAction(Request $request) {

        $validator = Validator::make($request->all(), [

            'pin' => 'required|digits:4|numeric',
            'pin_confirmation' => 'required|digits:4|numeric|same:pin',
        ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator)->withInput();
        }


        $pin = Hash::make($request->pin);

        $user = auth()->user();

        $user->update([

            'pin' => $pin,
        ]);

        return redirect()->back()->with('success', 'Pin Created Successfully');

    }


    public function updatePinAction(Request $request){


        $old_pin = Hash::make($request->old_pin);

        $validator = Validator::make($request->all(), [

            'old_pin' => 'required|exists:users,pin',
            'new_pin' => 'required|digits:4|numeric',
            'new_pin_confirmation' => 'required|digits:4|numeric|same:new_pin',

        ]);

        if($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $new_pin = Hash::make($request->pin);

        $user = auth()->user();

        $user->update([

            'pin' => $new_pin,
        ]);


        return redirect()->back()->with('success', 'Pin updated Successfully');

    }


}
