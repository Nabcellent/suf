<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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
Auth::routes(['verify' => true]);

//  Home Page Routes
Route::get('/', [IndexController::class, 'index'])->name('home');

/**
 *!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! PROTECTED ROUTES
 */

Route::middleware(['verified', 'auth'])->group(function() {
    //  User Account
    Route::match(['GET', 'POST'], '/account/{page?}/{id?}', [UserController::class, 'account'])
        ->middleware(['verified', 'auth'])->name('user-account');

    //  Delivery Addresses
    Route::post('/delivery-address/{id?}', [UserController::class, 'deliveryAddress'])
        ->whereNumber('id')->name('delivery-address');

    Route::get('/delete-delivery-address/{id}', [UserController::class, 'deleteAddress']);

    //  Get Sub-County by Id    ~   AJAX
    Route::post('/get-sub-counties', [AjaxController::class, 'getSubCountyById']);

    //  Check User Password     ~   AJAX
    Route::post('/check-password', [UserController::class, 'checkCurrentPassword']);

    //  Change Password
    Route::post('/change-password', [UserController::class, 'updatePassword'])
        ->middleware(['verified', 'auth'])->name('change-password');


    //  Apply Coupon
    Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply-coupon');


    //  Checkout
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('place-order');

    //  Thanks Page
    Route::get('/thank-you', [OrderController::class, 'thankYou'])->name('thank-you');

    //  Logout User
    Route::get('/logout', [LoginController::class, 'logout']);
});




//  Check if Email Exists
Route::match(['get', 'post'], '/check-email', [UserController::class, 'checkEmailExists']);
Route::match(['get', 'post'], '/check-phone', [UserController::class, 'checkPhoneExists']);


/**
 *!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! PRODUCT RELATED ROUTES
*/
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
Route::get('/cart', [ProductController::class, 'cart'])/*->middleware('password.confirm')*/;

//  Update Cart Item Quantity
Route::post('/update-cart-item-qty', [ProductController::class, 'updateCartItemQty']);

//  Delete Cart Item
Route::post('/delete-cart-item', [ProductController::class, 'deleteCartItem']);







Route::get('/policies', [PolicyController::class, 'index'])->middleware(['password.confirm']);
