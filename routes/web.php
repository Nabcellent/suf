<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CmsController as AdminCmsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\API\Mpesa\MpesaController;
use App\Http\Controllers\API\Mpesa\StkController;
use App\Http\Controllers\API\PayPal\PaypalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//  GUEST ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');

//  PRODUCT ROUTES
Route::get('/products/{categoryId?}', [ProductController::class, 'index'])->name('products');
Route::get('/product/{id}/{title}', [ProductController::class, 'showDetails'])->name('product-details');
Route::get('/search/products', [HomeController::class, 'search'])->name('search');

//  CART ROUTES
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');    //->middleware('password.confirm');
Route::post('/add-to-cart', [ProductController::class, 'storeCart']);
Route::post('/update-cart-item-qty', [ProductController::class, 'updateCartItemQty']);
Route::post('/delete-cart-item', [ProductController::class, 'deleteCartItem']);

//  ABOUT / CONTACT / TERMS & CONDITIONS
Route::get('/contact', [ContactUsController::class, 'showContactUsForm'])->name('contact-us');
Route::post('/contact', [ContactUsController::class, 'sendEmail'])->name('post_contact_us');//
Route::get('/info', [CmsController::class, 'index'])->name('info');
Route::get('/about-us', [CmsController::class, 'showAboutUs'])->name('about-us');

//  LOGOUT
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

//  AJAX ROUTES
Route::get('/get-filtered-products', [AjaxController::class, 'getFilteredProducts']);
Route::post('/get-product-price', [ProductController::class, 'getProductPrice']);   //  Get Variation price
//  Database Checks
Route::get('/check-email', [AjaxController::class, 'checkEmailExists']);
Route::get('/check-username', [AjaxController::class, 'checkUsernameExists']);
Route::get('/check-phone', [AjaxController::class, 'checkPhoneExists']);
Route::get('/check-national-id', [AjaxController::class, 'checkNationalIdExists']);


//  PROTECTED ROUTES
Route::middleware(['verified', 'auth'])->group(function() {
    //  USER PROFILE ROUTES
    Route::match(['GET', 'POST'], '/profile/{page?}/{id?}', [UserController::class, 'account'])->name('profile');
    Route::patch('/add-phone', [UserController::class, 'createUpdatePhone']);
    Route::patch('/upload-profile-image', [UserController::class, 'uploadProfilePic'])->name('profile-pic');
    Route::get('/delete-phone/{id}', [UserController::class, 'deletePhone']);
    Route::post('/delivery-address/{id?}', [UserController::class, 'deliveryAddress'])->whereNumber('id')->name('delivery-address');
    Route::get('/delete-delivery-address/{id}', [UserController::class, 'deleteAddress']);
    Route::get('/orders', [OrderController::class, 'showOrders'])->name('orders');
    Route::patch('/change-password', [UserController::class, 'updatePassword'])->name('change-password');
    Route::post('/delete-account', [UserController::class, 'deleteAccount'])->name('delete_account');

    //  CART ROUTES
    Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply-coupon');

    //  ORDER ROUTES
    Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('place-order');
    Route::get('/thank-you', [OrderController::class, 'thankYou'])->name('thank-you');
    Route::get('/lipa-na-mpesa', [MpesaController::class, 'show'])->name('mpesa');
    Route::get('/paypal', [PaypalController::class, 'show'])->name('paypal');
    Route::patch('/paypal/update-order-status', [PaypalController::class, 'updateOrderStatus']);

    //  MPESA ROUTES
    Route::prefix('payments/callbacks')->name('mpesa.stk.')->namespace('Mpesa')->group(function () {
        Route::any('stk_request', [StkController::class, 'initiatePush'])->name('request');
        Route::any('timeout_url/{section?}', [MpesaController::class, 'timeout']);
        Route::get('stk_status/{id}', [StkController::class, 'stkStatus']);
    });

    //  AJAX ROUTES
    Route::post('/get-sub-counties', [AjaxController::class, 'getSubCountyById']);
    Route::get('/check-password', [AjaxController::class, 'checkCurrentPassword']);
    Route::post('/get-product-price', [ProductController::class, 'getProductPrice']);   //  Get Variation price
});


//  ADMIN ROUTES
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {
    //  AUTH ROUTES
    Route::namespace('Auth')->group(function(){
        //Login Routes
        Route::get('/sign-in', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/sign-in',[\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('post_login');
        //Register Routes
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register',[RegisterController::class, 'register'])->name('post_register');
    });
    Route::post('/logout',[\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->middleware('admin')->name('logout');

    Route::middleware(['auth', 'admin', 'verified'])->group(function() {
        Route::get('/', function() {return redirect()->route('admin.dashboard');});
        Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

        ///////  E-COMMERCE
        //  Products Routes
        Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class,'showProducts'])->name('products');
        Route::get('/products/create', [\App\Http\Controllers\Admin\ProductController::class, 'showProductForm'])->name('create-product');
        Route::get('/product/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'getProduct'])->name('product');

        Route::get('/categories', [CategoryController::class, 'showCategories'])->name('categories');
        Route::get('/category/{id?}', [CategoryController::class, 'showCategoryForms'])->name('category');
        Route::match(['POST', 'PUT'],'/category/{id?}', [CategoryController::class, 'createUpdateCategory'])->name('post_put_category');
        Route::match(['POST', 'PUT'],'/sub-category/{id?}', [CategoryController::class, 'createUpdateSubCategory'])->name('sub-category');

        Route::get('/coupons', [\App\Http\Controllers\Admin\CouponController::class, 'showCoupons'])->name('coupons');
        Route::match(['GET', 'POST', 'PUT'], '/coupon/{id?}', [\App\Http\Controllers\Admin\CouponController::class, 'getCreateUpdate'])->name('coupon');
        Route::get('/attributes', [AttributeController::class, 'showAttributes'])->name('attributes');

        //  Overview Routes
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'showOrders'])->name('orders');
        Route::get('/order/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'showOrder'])->name('order');
        Route::patch('/order-ready/{id}/{checked}', [\App\Http\Controllers\Admin\OrderController::class, 'orderReady']);
        Route::get('/invoice/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'showInvoice'])->name('invoice');
        Route::get('/invoice-pdf/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'processInvoicePDF'])->name('invoice-pdf');
        Route::get('/payments', [PaymentController::class, 'list'])->name('payments');

        //  Content Routes
        Route::match(['GET', 'POST', 'PUT'],'/banners', [BannerController::class, 'getCreateUpdateBanners'])->name('banners');

        ///////  APPS
        /// Contacts
        Route::get('/contacts', [AppController::class, 'showContacts'])->name('contacts');
        Route::get('/emails', [AppController::class, 'showEmails'])->name('emails');

        ///////  USERS
        Route::get('/customers', [\App\Http\Controllers\Admin\UserController::class, 'showCustomers'])->name('customers');
        Route::get('/sellers', [\App\Http\Controllers\Admin\UserController::class, 'showSellers'])->name('sellers')->middleware('super');
        Route::get('/admins', [\App\Http\Controllers\Admin\UserController::class, 'showAdmins'])->name('admins')->middleware('red');
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'showAllUsers'])->name('users')->middleware('red');
        Route::get('/users/{user}/{id?}', [\App\Http\Controllers\Admin\UserController::class, 'getCreateUser'])->name('user');

        /////// CMS ROUTES
        Route::prefix('/cms')->name('cms.')->middleware('super')->group(function() {
            Route::get('/', [AdminCmsController::class, 'index'])->name('index');
            Route::get('/create', [AdminCmsController::class, 'create'])->name('create');
            Route::post('/store', [AdminCmsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AdminCmsController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [AdminCmsController::class, 'update'])->name('update');
        });

        //  Admin Routes
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('put_profile');
        Route::patch('/password', [AdminController::class, 'updatePassword'])->name('password');

        //  CREATE ROUTES
        Route::name('create.')->group(function() {
            Route::post('/products/create', [\App\Http\Controllers\Admin\ProductController::class, 'createProduct'])->name('product');
            Route::post('/product/variation/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'createVariation'])->name('variation');
            Route::post('/product/image/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'createImage'])->name('product-image');
            Route::post('/product/variation-option', [\App\Http\Controllers\Admin\ProductController::class, 'addVariationOption'])->name('variation-option');

            Route::post('/attribute')->name('attribute');
            Route::post('/brand', [AttributeController::class, 'createUpdateBrand'])->name('brand');

            Route::post('/users/{user}/{id?}', [\App\Http\Controllers\Admin\UserController::class, 'createUpdateAdmin'])->name('user');
        });

        //  UPDATE ROUTES
        Route::name('update.')->group(function() {
            Route::put('/product/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'updateProduct'])->name('product');
            Route::patch('/product/stock/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'setStock'])->name('stock');
            Route::patch('/product/extra-price/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'setPrice'])->name('extra-price');

            Route::put('/variation-option', [\App\Http\Controllers\Admin\ProductController::class, 'updateVariant']);

            Route::patch('/order/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'updateOrderStatus'])->name('order-status');

            Route::patch('/status/toggle-update', [\App\Http\Controllers\Admin\AjaxController::class, 'updateStatus']);
        });

        //  DELETE ROUTES
        Route::name('delete.')->group(function() {
            Route::delete('/product', [\App\Http\Controllers\Admin\ProductController::class, 'deleteProduct'])->name('product');
            Route::delete('/delete-product-image')->name('product-image');

            Route::delete('/delete/{id}/{model}', [\App\Http\Controllers\Admin\AjaxController::class, 'deleteFromTable']);
        });

        //  AJAX ROUTES
        Route::post('/get-categories', [\App\Http\Controllers\Admin\AjaxController::class, 'getCategoriesBySectionId']);
        Route::post('/get-sub-categories', [\App\Http\Controllers\Admin\AjaxController::class, 'getSubCategoriesByCategoryId']);
        Route::post('/get-attribute-values', [\App\Http\Controllers\Admin\AjaxController::class, 'getAttributeValuesByAttrId']);
        //  Database Checks
        Route::post('/check-variation', [AjaxController::class, 'checkVariationExists']);
        Route::post('/check-variation-option', [AjaxController::class, 'checkVariationOptionExists']);
        //  CHARTS ROUTE
        Route::post('/chart', [ChartController::class, 'getTimelyData']);


        //  SUPER ADMIN ROUTES
        Route::middleware('red')->group(function() {
            Route::prefix('/permissions')->name('permission.')->group(function() {
                Route::get('/', [PermissionController::class, 'index'])->name('index');
                Route::get('/create', [PermissionController::class, 'create'])->name('create');
                Route::post('/store', [PermissionController::class, 'store'])->name('store');
                Route::get('/show/{id}', [PermissionController::class, 'show'])->name('show');
                Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update');
            });
            Route::prefix('/roles')->name('role.')->group(function() {
                Route::get('/assign', [RoleController::class, 'showAssign'])->name('assign');
                Route::post('/assign/store', [RoleController::class, 'storeAssign'])->name('assign.store');
                Route::get('/assign/data', [RoleController::class, 'getAssignData']);
                Route::post('/store', [RoleController::class, 'store'])->name('store');
                Route::get('/show/{id}', [RoleController::class, 'show'])->name('show');
                Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
            });
        });
    });
});


//require __DIR__.'/auth.php';

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//
//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//


/*Route::any('/', function() {
    return view('temporary');
})->name('suspended');
Route::get('{anyExceptRoot}', function() {
    return redirect()->route('suspended');
})->where('anyExceptRoot', '.*');*/
