<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
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



Route::get('dashboard', [PagesController::class, 'dashboard'])->name('dashboard');

Route::get('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'register'])->name('register');

Route::get('forgotpassword', [AuthController::class, 'forgotpassword'])->name('forgotpassword');


