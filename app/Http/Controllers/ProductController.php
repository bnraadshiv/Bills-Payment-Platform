<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Product_api;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function addProduct() {

        $categories = Category::pluck('name', 'id');

        $aaa = Product_api::all();

        foreach($aaa as $aa) {

            //echo $aa['id'];
            //echo $aa['providerName'];

            $apis[$aa['id']] = $aa['providerName'];

        }

        //dd($apis)

        
        $statuses = [

            'active' => 'Active',
            'in-active' => 'In Active',

        ];

        $data = [

            'categories' => $categories,
            'statuses' => $statuses,
            'apis' => $apis,
        ];

        return view('addproduct', $data);
    }


    public function productAdder(Request $request){

        //dd($request);

        Product::create([

            'product_name' => $request->product_name,
            'image' => $request->image,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'apiID' => $request->apiID,

        ]);

        return redirect('addproduct')->with('success', 'Product Added Successfully');
    }


    public function allProducts() {

        $products = Product::with('category')->get();

        $products_count = $products->count();

        $data = [

            'products' => $products,
            'products_count' => $products_count,

        ];

        return view('allproducts', $data);

    }


    public function viewProduct($id) {

        //Eloquent find method
        $product = Product::find($id);

        if(empty($product)) {

            return abort(404);
        }

        $statuses = [

            'active' => 'Active',
            'in-active' => 'In Active',

        ];

        $data = [

            'statuses' => $statuses,
            'product' => $product,
        ];

        return view('view-product',  $data);

        //OR

        //Eloquent findOrFail method

        // $product = Product::findOrFail($id); //Has it's own abort to 404 page


        //OR
        //Eloquent first method - takes parameters different form primary key

        //$product = Product::where('id', $id)->first();    //Has it's own abort to 404 page

        //OR
        //Eloquent firstOrFail method 
        // $product = Product::where('id', $id)->firstOrFail();

        //Types of where
        // $product = Product::where('id', $id)->firstOrFail();

        // $product = Product::where('id', '>' ,$id)->firstOrFail(); //With comparator


         //$product = Product::where(['id' => $id, 'status' => 'active'])->firstOrFail(); //With multiple where parameters

        

    }

    public function updateProduct(Request $request, $id) {

        $product = Product::find($id);

        if(empty($product)) {

            return abort(404);
        }

        //Update model
        $product->update([

            'product_name' => $request->product_name,
            'image' => $request->image,
            'description' => $request->description,
            'status' => $request->status,

        ]);

        //OR
        // $product->product_name = $request->product_name;
        // $product->image = $request->image;
        // $product->status = $request->status;
        // $product->description = $request->description;
        // $product->save();


        //OR
        // Product::where('id', $id)->update([

        //     'product_name' => $request->product_name,
        //     'image' => $request->image,
        //     'description' => $request->description,
        //     'status' => $request->status,

        // ]);

        return redirect()->route('view-single-product', $product->id)->with('success', 'Product Updated Successfully');

    }




}
