<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactUsController;
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

Route::get('/', function() {
    return view('temporary');
});
/*
Auth::routes(['verify' => true]);

//  ADMIN ROUTES
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {
    //  AUTH ROUTES
    Route::namespace('Auth')->group(function(){
        //Login Routes
        Route::get('/sign-in', [Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/sign-in',[Admin\Auth\LoginController::class, 'login'])->name('login');
        //Register Routes
        Route::get('/register', [Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register',[Admin\Auth\RegisterController::class, 'register'])->name('register');

        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });
    Route::post('/logout',[Admin\Auth\LoginController::class, 'logout'])->middleware('admin')->name('logout');

    Route::middleware(['auth', 'admin', 'verified'])->group(function() {
        Route::get('/', function() {return redirect()->route('admin.dashboard');});
        Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

        //  Products Routes
        Route::get('/products', [Admin\ProductController::class,'showProducts'])->name('products');
        Route::get('/products/create', [Admin\ProductController::class, 'showProductForm'])->name('create-product');
        Route::get('/product/{id}', [Admin\ProductController::class, 'getProduct'])->name('product');

        Route::get('/categories', [Admin\CategoryController::class, 'showCategories'])->name('categories');
        Route::get('/category/{id?}', [Admin\CategoryController::class, 'showCategoryForms'])->name('category');
        Route::get('/coupons', [Admin\CouponController::class, 'showCoupons'])->name('coupons');
        Route::get('/attributes', [Admin\AttributeController::class, 'showAttributes'])->name('attributes');

        //  Overview Routes
        Route::get('/orders', [Admin\OrderController::class, 'showOrders'])->name('orders');
        Route::get('/order/{id}', [Admin\OrderController::class, 'showOrder'])->name('order');
        Route::get('/invoice/{id}', [Admin\OrderController::class, 'showInvoice'])->name('invoice');
        Route::get('/invoice-pdf/{id}', [Admin\OrderController::class, 'processInvoicePDF'])->name('invoice-pdf');
        Route::get('/payments')->name('payments');

        //  Content Routes
        Route::match(['GET', 'POST', 'PUT'],'/banners/{id?}', [Admin\PageContentController::class, 'getCreateUpdateBanners'])->name('banners');
        Route::match(['GET', 'POST', 'PUT'],'/ads/{id?}', [Admin\PageContentController::class, 'getCreateUpdateAds'])->name('ads');
        Route::match(['GET', 'POST', 'PUT'],'/policies/{id?}', [Admin\PageContentController::class, 'getCreateUpdatePolicies'])->name('policies');

        //  Users Routes
        Route::get('/customers', [Admin\UserController::class, 'showCustomers'])->name('customers');
        Route::get('/sellers', [Admin\UserController::class, 'showSellers'])->name('sellers');
        Route::get('/admins', [Admin\UserController::class, 'showAdmins'])->name('admins');
        Route::get('/users/{user}/{id?}', [Admin\UserController::class, 'getCreateUser'])->name('user');

        //  Admin Routes
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');

        //  MATCH ROUTES
        Route::match(['POST', 'PUT'],'/category/{id?}', [Admin\CategoryController::class, 'createUpdateCategory'])->name('category');
        Route::match(['POST', 'PUT'],'/sub-category/{id?}', [Admin\CategoryController::class, 'createUpdateSubCategory'])->name('sub-category');
        Route::match(['GET', 'POST', 'PUT'], '/coupon/{id?}', [Admin\CouponController::class, 'getCreateUpdate'])->name('coupon');

        //  CREATE ROUTES
        Route::name('create.')->group(function() {
            Route::post('/products/create', [Admin\ProductController::class, 'createProduct'])->name('product');
            Route::post('/product/variation/{id}', [Admin\ProductController::class, 'createVariation'])->name('variation');
            Route::post('/product/image/{id}', [Admin\ProductController::class, 'createImage'])->name('product-image');
            Route::post('/product/variation-option', [Admin\ProductController::class, 'addVariationOption'])->name('variation-option');

            Route::post('/attribute')->name('attribute');
            Route::post('/brand', [Admin\AttributeController::class, 'createUpdateBrand'])->name('brand');

            Route::post('/users/{user}/{id?}', [Admin\UserController::class, 'createUpdateAdmin'])->name('user');
        });

        //  UPDATE ROUTES
        Route::name('update.')->group(function() {
            Route::put('/product/{id}', [Admin\ProductController::class, 'updateProduct'])->name('product');
            Route::patch('/product/stock/{id}', [Admin\ProductController::class, 'setStock'])->name('stock');
            Route::patch('/product/extra-price/{id}', [Admin\ProductController::class, 'setPrice'])->name('extra-price');

            Route::put('/variation-option', [Admin\ProductController::class, 'updateVariant']);

            Route::patch('/order/{id}', [Admin\OrderController::class, 'updateOrderStatus'])->name('order-status');

            Route::patch('/status/toggle-update', [Admin\AjaxController::class, 'updateStatus']);
        });

        //  DELETE ROUTES
        Route::name('delete.')->group(function() {
            Route::delete('/product', [Admin\ProductController::class, 'deleteProduct'])->name('product');
            Route::delete('/delete-product-image')->name('product-image');

            Route::delete('/delete/{id}/{model}', [Admin\AjaxController::class, 'deleteFromTable']);
        });

        //  AJAX ROUTES
        Route::post('/get-categories', [Admin\AjaxController::class, 'getCategoriesBySectionId']);
        Route::post('/get-sub-categories', [Admin\AjaxController::class, 'getSubCategoriesByCategoryId']);
        Route::post('/get-attribute-values', [Admin\AjaxController::class, 'getAttributeValuesByAttrId']);
        //  Database Checks
        Route::post('/check-variation', [AjaxController::class, 'checkVariationExists']);
        Route::post('/check-variation-option', [AjaxController::class, 'checkVariationOptionExists']);
        //  CHARTS ROUTE
        Route::post('/chart', [ChartController::class, 'getTimelyOrderData']);
    });
});




//  Home Page Routes
Route::get('/', [HomeController::class, 'index'])->name('home');


//  PROTECTED ROUTES
Route::middleware(['verified', 'auth'])->group(function() {
    //  USER PROFILE ROUTES
    Route::match(['GET', 'POST'], '/profile/{page?}/{id?}', [UserController::class, 'account'])->name('profile');
    Route::patch('/add-phone', [UserController::class, 'createPhone']);
    Route::patch('/upload-profile-image', [UserController::class, 'uploadProfilePic'])->name('profile-pic');
    Route::get('/delete-phone/{id}', [UserController::class, 'deletePhone']);
    Route::post('/delivery-address/{id?}', [UserController::class, 'deliveryAddress'])->whereNumber('id')->name('delivery-address');
    Route::get('/delete-delivery-address/{id}', [UserController::class, 'deleteAddress']);
    Route::get('/orders', [OrderController::class, 'showOrders'])->name('orders');
    Route::post('/change-password', [UserController::class, 'updatePassword'])->name('change-password');

    //  CART ROUTES
    Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply-coupon');

    //  ORDER ROUTES
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('place-order');
    Route::get('/thank-you', [OrderController::class, 'thankYou'])->name('thank-you');

    //  AJAX ROUTES
    Route::post('/get-sub-counties', [AjaxController::class, 'getSubCountyById']);
    Route::post('/check-password', [AjaxController::class, 'checkCurrentPassword']);
    Route::post('/get-product-price', [ProductController::class, 'getProductPrice']);   //  Get Variation price
});


//  PRODUCT ROUTES
Route::get('/products/{categoryId?}', [ProductController::class, 'index'])->name('products');
Route::get('/product/{id}/{title}', [ProductController::class, 'details']);

//  CART ROUTES
Route::get('/cart', [ProductController::class, 'cart']);    //->middleware('password.confirm');
Route::post('/add-to-cart', [ProductController::class, 'addToCart']);
Route::post('/update-cart-item-qty', [ProductController::class, 'updateCartItemQty']);
Route::post('/delete-cart-item', [ProductController::class, 'deleteCartItem']);

//  ABOUT / CONTACT / TERMS & CONDITIONS
Route::get('/contact', [ContactUsController::class, 'showContactUsForm'])->name('contact-us');
Route::post('/contact', [ContactUsController::class, 'sendEmail'])->name('contact-us');
Route::get('/policies', [PolicyController::class, 'index'])->middleware(['password.confirm'])->name('policies');
Route::get('/about-us', [PolicyController::class, 'showAboutUs'])->name('about-us');

//  LOGOUT
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

//  AJAX ROUTES
Route::post('/get-product-price', [ProductController::class, 'getProductPrice']);   //  Get Variation price
//  Database Checks
Route::match(['get', 'post'], '/check-email', [AjaxController::class, 'checkEmailExists']);
Route::match(['get', 'post'], '/check-username', [AjaxController::class, 'checkUsernameExists']);
Route::match(['get', 'post'], '/check-phone', [AjaxController::class, 'checkPhoneExists']);*/




/*Route::get('/test', function() {
    Storage::disk('google')->put('test.txt', 'Hello World');

    echo "done";
});*/
