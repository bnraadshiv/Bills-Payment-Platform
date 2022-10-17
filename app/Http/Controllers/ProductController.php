<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;
use App\Models\Product_api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function addProduct() {

        $categories = Category::pluck('name', 'id');

        $aaa = Provider::all();

        foreach($aaa as $aa) {

            //echo $aa['id'];
            //echo $aa['providerName'];

            $providers[$aa['id']] = $aa['name'];

        }

        //dd($apis)

        
        $statuses = [

            'active' => 'Active',
            'in-active' => 'In Active',

        ];

        $data = [

            'categories' => $categories,
            'statuses' => $statuses,
            'providers' => $providers,
        ];

        return view('addproduct', $data);
    }


    public function productAdder(Request $request){

        //Validation


        $rules = [
            'name' => 'required|min:3|max:255|unique:products,name',
        'serviceID' => ['required', 'unique:products'], //Option 2, can be written as an array
        'category_id' => 'required',
        'image' => 'required',
        'provider_id' => 'required',
        ];

        $messages = 
        [
            'name.required' => 'Please enter a valid product name',
            'name.min' => 'Please enter name that is greater than 3 characters',
            'category_id.required' => 'Please select a category',
        ];

        //$request->validate($rules, $messages); //Method one
        //method one redirects automatically, hence can't be used for things like API of where you want more
        //control of what happens after

        //Method 2 for validation

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();

            //return response()->json(['errors' => $validator->errors()->all()]); This can used used for API responses
        }


        //dd($request);

        Product::create([

            'name' => $request->name,
            'image' => $request->image,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'provider_id' => $request->provider_id,
            'serviceID' => $request->serviceID,

        ]);

        return redirect('addproduct')->with('success', 'Product Added Successfully');
    }


    public function allProducts() {

        $products = Product::with('category', 'product_api')->withTrashed()->get(); //Lazy loading

       // dd($products);

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


    public function deleteProduct($id) {

        $product = Product::find($id);

        if(empty($product)) {

            return abort(404);
        }

        $product->delete(); //Does soft delete

        return redirect()->back()->with('success', 'Product Deleted Successfully');


    //$product->forceDelete() -- Will delete permanently

    //$product->restore -- Will restore what was soft deleted

    }





}
