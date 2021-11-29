<?php

use App\Helpers\Aid;
use App\Models\{Attribute, Banner, Brand, Cart, Category, CmsPage, Coupon, Order, OrdersProduct, Phone};
use App\Models\{Admin, Product, ProductImage, Review, User, Variation};
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\{Auth, DB, Session};
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;
use Spatie\Permission\Models\{Permission, Role};

function isRed(): bool {
    return Auth::user()->is_admin === 7;
}

function isSeller(): bool {
    return Auth::user()->admin && Auth::user()->admin->type === 'Seller';
}

function isAdmin(): bool {
    return isRed() || Auth::user()->admin && Auth::user()->admin->type === 'Admin';
}

function isTeamSA(): bool {
    return isRed() || isAdmin() || isSeller();
}

function carbon(): Carbon {
    return new Carbon();
}


function alert($type, $intro, $message, $duration, $link = null): array {
    return [
        'type'     => $type,
        'intro'    => $intro,
        'message'  => $message,
        'duration' => $duration,
        'link'     => $link
    ];
}

function sections(): Collection|array {
    return Category::sections();
}

function latestFour(): Collection|array {
    return Product::with('subCategory', 'brand', 'seller')->where('products.status', 1)->whereIsFeatured(true)
        ->has('variations')->orderByDesc('products.created_at')->limit(4)->get();
}

function latestProductId() {
    return Product::latest('id')->value('id');
}

function trendingCategories(): \Illuminate\Support\Collection {
    if(!Session::has('trendingCategories')) {
        $trendingCategories = OrdersProduct::select([
            'cat.id',
            'cat.title AS category',
            DB::raw('COUNT(cat.title) as count')
        ])->join('products AS p', 'orders_products.product_id', 'p.id')
            ->join('categories AS sub', 'p.category_id', 'sub.id')
            ->join('categories AS cat', 'sub.category_id', 'cat.id')->groupBy('category', 'cat.id')
            ->orderByDesc('count')->limit(5)->get();

        Session::put('trendingCategories', $trendingCategories);
    }

    return Session::get('trendingCategories');
}

//  COUNT FUNCTIONS
function tableCount($tableName): int {
    return match ($tableName) {
        'products' => (Auth::check() && isSeller())
            ? Product::where('seller_id', Auth::id())->count()
            : Product::count(),
        'orders' => (Auth::check() && isSeller())
            ? Order::getSellerOrders()->count()
            : Order::count(),
        'categories' => Category::whereNotNull('section_id')->count(),
        'admins' => Admin::where('type', 'Super')->count(),
        'sellers' => Admin::where('type', 'Seller')->count(),
        'qtySold' => Order::where('status', 'Completed')->count(),
        'customers' => User::where('is_admin', 0)->count(),
    };

    /*return [
        'brands' => Brand::all()->count(),
        'phones' => Phone::all()->count(),
    ];*/
}

function setCartItems(): void {
    $total = $count = 0;

    try {
        $cart = Cart::cartItems();

        foreach($cart as $item) {
            $discountPrice = Cart::getVariationPrice($item['product_id'], $item['details'])['discount_price'];
            $total += ($discountPrice * $item['quantity']);
        }

        if(Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->sum('quantity');
        } else if(!empty(Session::get('session_id'))) {
            $count = Cart::where('session_id', Session::get('session_id'))->sum('quantity');
        }

        Session::put('cartTotal', currencyFormat($total));
        Session::put('cartCount', $count);
    } catch (Exception $e) {
        Log::error($e->getMessage());
    }
}

function getCart($item = 'total' | 'count') {
    if(!Session::has('cartTotal') || !Session::has('cartCount')) {
        setCartItems();
    }

    $cartItem = match ($item) {
        'total' => 'cartTotal',
        default => 'cartCount'
    };

    return Session::get($cartItem);
}

function getVariationPrice($productId, $productDetails): array {
    return Cart::getVariationPrice($productId, $productDetails);
}


#[Pure]
function currencyFormat($number): string {
    return number_format((float)$number, 2);
}

function currencyToFloat($currency): float {
    return (float)preg_replace('/[^\d.]/', '', $currency);
}

function mapped_implode($glue, $array, $symbol = '='): string {
    return implode($glue, array_map(static function($k, $v) use ($symbol) {
        return $k . $symbol . $v;
    }, array_keys($array), array_values($array)));
}

function getGenderIcon($gender): string {
    if($gender === 'Male') {
        return '<i class="bx bx-male-sign"></i>';
    }

    return "<i class='bx bx-female-sign'></i>";
}

function getModel($model): string {
    $model = Str::ucfirst(Str::lower($model));

    return match ($model) {
        'User' => User::class,
        'Phone' => Phone::class,
        'Attribute' => Attribute::class,
        'Banner' => Banner::class,
        'Brand' => Brand::class,
        'Category' => Category::class,
        'Product' => Product::class,
        'Order' => Order::class,
        'Coupon' => Coupon::class,
        'Cmspage' => CmsPage::class,
        'Role' => Role::class,
        'Permission' => Permission::class,
        'Review' => Review::class,
        'Variation', 'Variations_option' => Variation::class,
        'Product\'s image' => productImage::class,
    };
}

function orderProductsReady($orderId): bool {
    return Order::orderProductsReady($orderId);
}


/** chart   */
function chartDateFormat($date, $frequency = 'daily'): string {
    return match ($frequency) {
        'monthly' => Carbon::parse($date)->format('Y-m'),
        'weekly' => Carbon::parse($date)->format('W'),
        default => Carbon::parse($date)->toDateString()
    };
}

function chartStartDate($frequency): \Illuminate\Support\Carbon {
    return match ($frequency) {
        'monthly' => now()->subMonths(3),
        'weekly' => now()->subWeeks(4),
        default => now()->subWeek()
    };
}


if(!function_exists('randomQuote')) {
    function randomQuote() {
        $quotes = [
            [
                "quote"   => "Elegance is elimination.",
                "caption" => "Cristóbal Balenciaga",
            ],
            [
                "quote"   => "People will stare. Make it worth their while.",
                "caption" => "Harry Winston",
            ],
            [
                "quote"   => "When in doubt, wear red.",
                "caption" => "Bill Blass",
            ],
        ];

        if(Auth::check()) {
            if(!(bool)strcasecmp(Auth::user()->gender, "Male")) {
                //  Is Male is true
                $quotes = [
                    ...$quotes,
                    [
                        "quote"   => "The joy of dressing is an art.",
                        "caption" => "Azzedine Alaïa",
                    ],
                ];
            } else {
                //  Is FeMale
                $quotes = [
                    ...$quotes,
                    [
                        "quote"   => "I make clothes, women make fashion.",
                        "caption" => "Azzedine Alaïa",
                    ],
                ];
            }
        }

        return Arr::random($quotes);
    }
}

function shareLink(): array|string {
    return \Share::page(url()->current(), 'Your share text comes here',)->facebook()->twitter()->linkedin()->telegram()
        ->whatsapp()->getRawLinks();
}

function accessDenied(): Redirector|Application|RedirectResponse {
    $message = (Auth::user()->gender === "Male"
            ? 'Iza Bro!'
            : 'Sorryyy!') . " Access Denied.";

    return Aid::goWithError($message, 'admin.dashboard');
}


/**
 *          ---------------------     ---------------------     ---------------------     ALERT HELPERS
 */
function createOk($msg = 'Created successfully!', $routeName = null): RedirectResponse {
    return goWithSuccess($msg, $routeName);
}

function createFail($msg = 'Creation Failed!', $routeName = null): RedirectResponse {
    return goWithError($msg, $routeName);
}

function updateOk($msg = 'Update successful!', $routeName = null): RedirectResponse {
    return goWithSuccess($msg, $routeName);
}

function updateFail($msg = 'Update failed!', $routeName = null): RedirectResponse {
    return goWithError($msg, $routeName);
}

function deleteOk($routeName = null): RedirectResponse {
    return goWithSuccess("Delete Successful!", $routeName);
}


function goWithSuccess($msg, $to = null): RedirectResponse {
    $route = $to
        ? redirect($to)
        : redirect()->back();

    return $route->with("toast_success", $msg);
}

function goWithInfo($msg, $to = null): RedirectResponse {
    $route = $to
        ? redirect($to)
        : redirect()->back();

    return $route->with("toast_info", $msg);
}

function goWithError($msg = "Error...! ☹", $to = null): RedirectResponse {
    $route = $to
        ? redirect($to)
        : redirect()->back();

    return $route->with("toast_error", $msg);
}

function toastError($serverError, $clientMessage): RedirectResponse {
    Log::error($serverError);

    return redirect()->back()->withInput()->with('toast_error', $clientMessage);
}
