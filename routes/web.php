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
use App\Http\Controllers\{ReviewController,
    CmsController,
    ContactUsController,
    CouponController,
    HomeController,
    OrderController,
    ProductController,
    UserController};
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\AjaxController as AdminAjaxController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
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

    //  REVIEW ROUTES
    Route::prefix('/reviews')->name('review.')->group(function() {
        Route::post('/store', [ReviewController::class, 'store'])->name('store');
    });

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
    //  AUTHENTICATION ROUTES
    Route::namespace('Auth')->group(function(){
        Route::get('/sign-in', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/sign-in',[AdminLoginController::class, 'login'])->name('post_login');
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register',[RegisterController::class, 'register'])->name('post_register');
    });
    Route::post('/logout',[AdminLoginController::class, 'logout'])->middleware('admin')->name('logout');

    Route::middleware(['auth', 'admin', 'verified'])->group(function() {
        Route::get('/', function() {return redirect()->route('admin.dashboard');});
        Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

        //  PRODUCT ROUTES
        Route::prefix('/products')->name('product.')->group(function() {
            Route::get('/', [AdminProductController::class, 'index'])->name('index');
            Route::get('/create', [AdminProductController::class, 'create'])->name('create');
            Route::post('/store', [AdminProductController::class, 'store'])->name('store');
            Route::get('/show/{id}', [AdminProductController::class, 'show'])->name('show');
        });

        Route::get('/categories', [CategoryController::class, 'showCategories'])->name('categories');
        Route::get('/category/{id?}', [CategoryController::class, 'showCategoryForms'])->name('category');
        Route::match(['POST', 'PUT'],'/category/{id?}', [CategoryController::class, 'createUpdateCategory'])->name('post_put_category');
        Route::match(['POST', 'PUT'],'/sub-category/{id?}', [CategoryController::class, 'createUpdateSubCategory'])->name('sub-category');

        Route::get('/coupons', [AdminCouponController::class, 'showCoupons'])->name('coupons');
        Route::match(['GET', 'POST', 'PUT'], '/coupon/{id?}', [AdminCouponController::class, 'getCreateUpdate'])->name('coupon');
        Route::get('/attributes', [AttributeController::class, 'showAttributes'])->name('attributes');

        //  Overview Routes
        Route::get('/orders', [AdminOrderController::class, 'showOrders'])->name('orders');
        Route::get('/order/{id}', [AdminOrderController::class, 'showOrder'])->name('order');
        Route::patch('/order-ready/{id}/{checked}', [AdminOrderController::class, 'orderReady']);
        Route::get('/invoice/{id}', [AdminOrderController::class, 'showInvoice'])->name('invoice');
        Route::get('/invoice-pdf/{id}', [AdminOrderController::class, 'processInvoicePDF'])->name('invoice-pdf');
        Route::get('/payments', [PaymentController::class, 'list'])->name('payments');

        //  Content Routes
        Route::match(['GET', 'POST', 'PUT'],'/banners', [BannerController::class, 'getCreateUpdateBanners'])->name('banners');

        /// Contacts
        Route::get('/contacts', [AppController::class, 'showContacts'])->name('contacts');
        Route::get('/emails', [AppController::class, 'showEmails'])->name('emails');

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
            Route::post('/product/variation/{id}', [AdminProductController::class, 'createVariation'])->name('variation');
            Route::post('/product/image/{id}', [AdminProductController::class, 'createImage'])->name('product-image');
            Route::post('/product/variation-option', [AdminProductController::class, 'addVariationOption'])->name('variation-option');

            Route::post('/attribute')->name('attribute');
            Route::post('/brand', [AttributeController::class, 'createUpdateBrand'])->name('brand');
        });

        //  UPDATE ROUTES
        Route::name('update.')->group(function() {
            Route::put('/product/{id}', [AdminProductController::class, 'updateProduct'])->name('product');
            Route::patch('/product/stock/{id}', [AdminProductController::class, 'setStock'])->name('stock');
            Route::patch('/product/extra-price/{id}', [AdminProductController::class, 'setPrice'])->name('extra-price');

            Route::put('/variation-option', [AdminProductController::class, 'updateVariant']);
            Route::patch('/order/{id}', [AdminOrderController::class, 'updateOrderStatus'])->name('order-status');
            Route::patch('/status/toggle-update', [AdminAjaxController::class, 'updateStatus']);
        });

        //  DELETE ROUTES
        Route::name('delete.')->group(function() {
            Route::delete('/product', [AdminProductController::class, 'deleteProduct'])->name('product');
            Route::delete('/delete-product-image')->name('product-image');
            Route::delete('/delete', [AdminAjaxController::class, 'deleteFromTable']);
        });

        //  AJAX ROUTES
        Route::post('/get-categories', [AdminAjaxController::class, 'getCategoriesBySectionId']);
        Route::post('/get-sub-categories', [AdminAjaxController::class, 'getSubCategoriesByCategoryId']);
        Route::post('/get-attribute-values', [AdminAjaxController::class, 'getAttributeValuesByAttrId']);
        //  Database Checks
        Route::post('/check-variation', [AjaxController::class, 'checkVariationExists']);
        Route::post('/check-variation-option', [AjaxController::class, 'checkVariationOptionExists']);
        //  CHARTS ROUTE
        Route::post('/chart', [ChartController::class, 'getTimelyData']);

        ///////  USERS
        Route::get('/customers', [AdminUserController::class, 'showCustomers'])->name('customers');
        Route::get('/sellers', [AdminUserController::class, 'showSellers'])->name('sellers')->middleware('admin');
        Route::get('/admins', [AdminUserController::class, 'showAdmins'])->name('admins')->middleware('red');
        Route::get('/users', [AdminUserController::class, 'showAllUsers'])->name('users')->middleware('red');
        Route::prefix('/users')->name('user.')->group(function() {
            Route::get('/create/{user}', [AdminUserController::class, 'create'])->name('create');
            Route::post('/store/{user}', [AdminUserController::class, 'store'])->name('store');
            Route::get('/edit/{user}/{id}', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/update/{title}/{id}', [AdminUserController::class, 'update'])->name('update');
        });

        Route::prefix('/reviews')->name('review.')->middleware('super')->group(function() {
            Route::get('/', [ReviewController::class, 'index'])->name('index');
            Route::get('/rate', [ReviewController::class, 'index'])->name('index');
        });

        //  SUPER ADMIN ROUTES
        Route::middleware('red')->group(function() {
            //  ROLES AND PERMISSIONS
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
