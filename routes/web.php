<?php

use Illuminate\Support\Facades\Route;

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

/**
 * *************    ************    ************    ************    GET REQUESTS
*/

Route::get('/', [IndexController::class, 'index']);

Route::get('/sign-in', function() {
    return view('login');
});

Route::get('/sign-out', [UserController::class, 'signOut']);

Route::get('/register', function() {
    return view('register');
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/contact-us', function() {
    return view('contact_us');
});

Route::get('/profile/{page}', function() {
    return view('profile');
});

Route::get('/details/{id}', [ProductController::class, 'productDetails']);

Route::get('/cart', [ProductController::class, 'cart']);

Route::get('/policies', [PolicyController::class, 'index']);



/**
 * *************    ************    ************    ************    POST REQUESTS
 */

Route::post('/sign-in', [UserController::class, 'authenticate']);

Route::post('/register', [UserController::class, 'create']);

Route::post('/profile/update-user', [UserController::class, 'update']);

Route::post('/cart', [ProductController::class, 'addToCart']);


//  Listing Routes
Route::get('/products/{url}', [ProductController::class, 'listing']);
