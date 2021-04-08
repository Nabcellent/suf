<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PolicyController;

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

//  Home Page Routes
Route::get('/', [IndexController::class, 'index'])->name('home');

//  Product Routes
Route::get('/products', [ProductController::class, 'index']);
//  Get category Url
$carUrls = Category::select('id')->where('status', 1)->get()->pluck('id')->toArray();
foreach($carUrls as $url) {
    Route::get('/products/' . $url, [ProductController::class, 'index']);
}

//  Product Details Route
Route::get('/product/{id}/{title}', [ProductController::class, 'details']);
//  Get Variation price
Route::post('/get-product-price', [ProductController::class, 'getProductPrice']);

//  Add to Cart Route
Route::post('/add-to-cart', [ProductController::class, 'addToCart']);

//  Shopping Cart Route
Route::get('/cart', [ProductController::class, 'cart']);



Route::get('/sign-in', function() {
    return view('login');
});

Route::get('/sign-out', [UserController::class, 'signOut']);

Route::get('/register', function() {
    return view('register');
});

Route::get('/profile/{page}', function() {
    return view('profile');
});

Route::get('/details/{id}', [ProductController::class, 'productDetails']);

Route::get('/policies', [PolicyController::class, 'index']);



/**
 * *************    ************    ************    ************    POST REQUESTS
 */

Route::post('/sign-in', [UserController::class, 'authenticate']);

Route::post('/register', [UserController::class, 'create']);

Route::post('/profile/update-user', [UserController::class, 'update']);

Route::post('/cart', [ProductController::class, 'addToCart']);


//  Listing Routes
//Route::get('/products/{url}', [ProductController::class, 'listing']);
