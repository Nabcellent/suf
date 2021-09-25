<?php

use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CmsPage;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Phone;
use App\Models\Product;
use App\Models\productsImage;
use App\Models\User;
use App\Models\Variation;
use App\Models\VariationsOption;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

function User(): ?Authenticatable {
    return Auth::user();
}
function isRed(): bool {
    return User()->is_admin === 7;
}
function isSeller(): bool {
    if(isAdmin()) {
        return Admin::where('user_id', Auth::id())->first()->type === 'Seller';
    }

    return false;
}
function isSuper(): bool {
    if(isAdmin()) {
        return Admin::where('user_id', Auth::id())->first()->type === "Super";
    }
    return false;
}
function isAdmin(): bool {
    if(Auth::check()) {
        return User()->is_admin === 1;
    }

    return false;
}
function isTeamRSu(): bool {
    return isRed() || isSuper();
}


function alert($type, $intro, $message, $duration, $link = null): array {
    return [
        'type' => $type,
        'intro' => $intro,
        'message' => $message,
        'duration' => $duration,
        'link' => $link
    ];
}

function sections(): Collection|array {
    return Category::sections();
}
function latestFour(): Collection|array {
    return Product::products()->where('products.status', 1)->where('is_featured', 'Yes')->has('variations')
        ->orderByDesc('products.created_at')->limit(4)->get();
}
function latestProductId() {
    return Product::latest('id')->value('id');
}
function trendingCategories(): \Illuminate\Support\Collection {
    if(!Session::has('trendingCategories')) {
        $trendingCategories = OrdersProduct::select(['cat.id', 'cat.title AS category', DB::raw('COUNT(cat.title) as count')])
            ->join('products AS p', 'orders_products.product_id', 'p.id')
            ->join('categories AS sub', 'p.category_id', 'sub.id')
            ->join('categories AS cat', 'sub.category_id', 'cat.id')
            ->groupBy('category', 'cat.id')->orderByDesc('count')->limit(5)
            ->get();

        Session::put('trendingCategories', $trendingCategories);
    }

    return Session::get('trendingCategories');
}

//  COUNT FUNCTIONS
function tableCount(): array {
    if(isSeller()) {
        $products = Product::where('seller_id', Auth::id())->count();
        $orders = Order::getSellerOrders()->count();
    } else {
        $products = Product::all()->count();
        $orders = Order::all()->count();
    }

    return [
        'products' => $products,
        'categories' => Category::whereNotNull('section_id')->count(),
        'orders' => $orders,
        'customers' => User::where('is_admin', 0)->count(),
        'sellers' => Admin::where('type', 'Seller')->count(),
        'admins' => Admin::where('type', 'Super')->count(),
        'brands' => Brand::all()->count(),
        'phones' => Phone::all()->count(),
        'qtySold' => Order::where('status', 'Conpleted')->count()
    ];
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
    } catch(Exception $e) {
        Log::error($e->getMessage());
    }
}

function getCart($item = 'total' | 'count') {
    if(!Session::has('cartTotal') || !Session::has('cartCount')) {
        setCartItems();
    }

    $cartItem = match($item) {
        'total' => 'cartTotal',
        default => 'cartCount'
    };

    return Session::get($cartItem);
}

function getDiscountPrice($productId): int {
    return Product::getDiscountPrice($productId);
}



#[Pure] function currencyFormat($number): string {
    return number_format((float)$number, 2);
}

function currencyToFloat($currency): float {
    return (float)preg_replace('/[^\d.]/', '', $currency);
}

function mapped_implode($glue, $array, $symbol = '='): string {
    return implode($glue, array_map(
            static function($k, $v) use($symbol) {
                return $k . $symbol . $v;
            },
            array_keys($array),
            array_values($array)
        )
    );
}

function getGenderIcon($gender): string {
    if($gender ==='Male') {
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
        'Variation', 'Variations_option' => Variation::class,
        'Product\'s Image' => productsImage::class,
    };
}

function orderProductsReady($orderId): bool {
    return Order::orderProductsReady($orderId);
}

function accessDenied(): Redirector|Application|RedirectResponse {
    if(Auth::check()) {
        $intro = Auth::user()->gender === "Male" ? 'Iza Bro!' : 'Sorryyy!';
    } else {
        $intro = "!";
    }

    return back()->with('alert', [
        'type' => 'danger',
        'intro' => $intro,
        'message' => "Access Denied.",
        'duration' => 7
    ]);
}
