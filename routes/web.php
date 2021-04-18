<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');

//  ADMIN ROUTES
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {
    //  AUTH ROUTES
    Route::namespace('Auth')->group(function(){
        //Login Routes
        Route::get('/sign-in', [Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login',[Admin\Auth\LoginController::class, 'login'])->name('login');
        Route::post('/logout',[Admin\Auth\LoginController::class, 'logout'])->name('logout');

        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });

    Route::middleware(['admin'])->group(function() {
        Route::get('/', [IndexController::class, 'index'])->name('dashboard');

        //  Products Routes
        Route::get('/products', [Admin\ProductController::class,'showProducts'])->name('products');
        Route::match(['GET', 'POST'],'/products/create', [Admin\ProductController::class, 'getCreateProduct'])->name('create-product');
        Route::get('/product/{id}', [Admin\ProductController::class, 'showProduct'])->name('product');

        Route::get('/categories', [Admin\CategoryController::class, 'showCategories'])->name('categories');
        Route::get('/coupons', [Admin\CouponController::class, 'showCoupons'])->name('coupons');
        Route::match(['GET', 'POST', 'PUT'], '/coupon/{id?}', [Admin\CouponController::class, 'getCreateUpdate'])->name('coupon');
        Route::get('/attributes', [Admin\AttributeController::class, 'showAttributes'])->name('attributes');

        //  Overview Routes
        Route::get('/orders', [Admin\OrderController::class, 'showOrders'])->name('orders');
        Route::get('/payments')->name('payments');

        //  Content Routes
        Route::get('/banners')->name('banners');
        Route::get('/ads')->name('ads');
        Route::get('/policies')->name('policies');

        //  Users Routes
        Route::get('/customers', [Admin\UserController::class, 'showCustomers'])->name('customers');
        Route::get('/sellers', [Admin\UserController::class, 'showSellers'])->name('sellers');
        Route::get('/admins', [Admin\UserController::class, 'showAdmins'])->name('admins');

        Route::get('/admin/profile')->name('profile');

        Route::get('/invoice-pdf/{id}', [Admin\OrderController::class, 'printInvoicePDF'])->name('invoice-pdf');


        //  CREATE ROUTES
        Route::name('create.')->group(function() {
            Route::post('/product/variation')->name('variation');
            Route::post('/product/image')->name('product-image');
            Route::post('/delete-product-image')->name('product-image');

            Route::post('/attribute')->name('attribute');
        });

        //  UPDATE ROUTES
        Route::name('update.')->group(function() {
            Route::put('/product/{id}')->name('product');
            Route::patch('/product/stock/')->name('stock');
            Route::patch('/product/extra-price')->name('extra-price');
        });

        //  DELETE ROUTES
        Route::name('delete.')->group(function() {
            Route::delete('/product')->name('product');
            Route::delete('/delete-product-image')->name('product-image');
        });
    });
});

/**
 *!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! PROTECTED ROUTES
 */

Route::middleware(['verified', 'auth'])->group(function() {
    //  User Account
    Route::match(['GET', 'POST'], '/account/{page?}/{id?}', [UserController::class, 'account'])
        ->middleware(['verified', 'auth'])->name('user-account');

    //  Phone Numbers
    Route::patch('/add-phone', [UserController::class, 'updatePhone']);

    Route::get('/delete-phone/{id}', [UserController::class, 'deletePhone']);

    //  Delivery Addresses
    Route::post('/delivery-address/{id?}', [UserController::class, 'deliveryAddress'])
        ->whereNumber('id')->name('delivery-address');

    Route::get('/delete-delivery-address/{id}', [UserController::class, 'deleteAddress']);

    //  Users Orders
    Route::get('/orders', [OrderController::class, 'showOrders'])->name('orders');

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
Route::get('/products/{categoryId?}', [ProductController::class, 'index']);

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
