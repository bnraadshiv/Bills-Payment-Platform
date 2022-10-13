<?php

namespace App\Http\Controllers;

use App\Models\Product_api;
use Illuminate\Http\Request;

class Product_apiController extends Controller
{
    //
    public function addAPI() {

        return view('api.addapi');
    }


    public function addAPIaction(Request $request){

        $product_api = Product_api::create([

            'providerName' => $request->providerName,
        ]);

        if ($product_api) {

            return redirect()->route('addapi')->with('success', 'API created successfully');

        }else {

            return redirect()->route('addapi')->with('failed', 'Error! API not creatd succcessfully');
        }

    }

    public function  viewAllApis() {

        $apis = Product_api::all();


        if($apis) {

            return view('api.allapis', compact('apis'));
        }
    }


    public function viewSingleApi($id) {

        $api = Product_api::where('id', $id)->first();

        //dd($api);

        return view('api.singleapi', compact('api'));
    }






}
