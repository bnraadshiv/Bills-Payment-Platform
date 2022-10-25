<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Product_apiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [TestController::class, 'login']);


Route::get('register', [TestController::class, 'register']);

Route::post('register', [TestController::class, 'registerAction']);


//Products

Route::get('addproduct', [ProductController::class, 'addProduct']);

Route::post('addproduct', [ProductController::class, 'productAdder']);

Route::get('products', [ProductController::class, 'allProducts'])->name('all-products');

Route::get('view-product/{id}', [ProductController::class, 'viewProduct'])->name('view-single-product');


Route::get('delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete-single-product');


Route::post('update-product/{id}', [ProductController::class, 'updateProduct'])->name('update-single-product');


//Product API

Route::get('add-api', [Product_apiController::class, 'addAPI'])->name('addapi');

Route::post('add-api', [Product_apiController::class, 'addAPIaction'])->name('apiadder');

Route::get('apis', [Product_apiController::class, 'viewAllApis'])->name('allApis');

Route::get('api/{id}', [Product_apiController::class, 'viewSingleApi'])->name('singleApi');




Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('login', [AuthController::class, 'loginAction'])->name('loginAction');

Route::get('register', [AuthController::class, 'register'])->name('register');

Route::post('register', [AuthController::class, 'registerAction'])->name('registerAction');

Route::get('forgotpassword', [AuthController::class, 'forgotpassword'])->name('forgotpassword');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::group(['prefix' => 'customer', 'middleware' => 'auth'], function() {

    //Pages Actions
    Route::get('dashboard', [PagesController::class, 'dashboard'])->name('customer_dashboard');

    //Customer Action

    Route::get('profile', [CustomerController::class, 'profile'])->name('customer_profile');

    Route::post('update-profile', [CustomerController::class, 'updateProfile'])->name('customer_update_profile');

    Route::post('update-profile-image', [CustomerController::class, 'uploadImage'])->name('customer_update_profile_image');


    Route::get('update-password', [CustomerController::class, 'updatePassword'])->name('customer_update_password');


    Route::post('update-password', [CustomerController::class, 'updatePasswordAction'])->name('customer_update_passwordAction');

    Route::get('pin-setup', [CustomerController::class, 'createCustomerPin'])->name('customer_pin');

    Route::post('pin-stup', [CustomerController::class, 'createPinAction'])->name('createPinAction');

    Route::post('pin-update', [CustomerController::class, 'updatePinAction'])->name('customer_updatePin');

    
    
});



