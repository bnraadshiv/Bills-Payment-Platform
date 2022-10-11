<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function addProduct() {

        return view('addproduct');
    }


    public function productAdder(Request $request){

        //dd($request);

        Product::create([

            'product_name' => $request->product_name,
            'image' => $request->image,
            'description' => $request->description,

        ]);

        return redirect('addproduct')->with('product_success', 'Product Added Successfully');
    }


    public function allProducts() {

        $products = Product::all();

        $products_count = $products->count();

        $data = [

            'products' => $products,
            'products_count' => $products_count,

        ];

        return view('allproducts', $data);

    }




}
