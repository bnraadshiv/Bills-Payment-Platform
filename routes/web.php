<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;

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

Route::get('register', [TestController::class, 'register']);

Route::post('register', [TestController::class, 'registerAction']);



Route::get('/addproduct', [ProductController::class, 'addProduct']);

Route::post('/addproduct', [ProductController::class, 'productAdder']);

Route::get('/products', [ProductController::class, 'allProducts']);


