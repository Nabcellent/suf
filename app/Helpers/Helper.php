<?php

use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
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

function sections() {
    return Category::sections();
}
function latestFour(): array {
    return Product::products()->where('products.status', 1)->where('is_featured', 'Yes')->has('variations')
        ->orderByDesc('products.created_at')->limit(4)->get()->toArray();
}
function latestProductId() {
    return Product::latest('id')->value('id');
}
function trendingCategories(): Collection|array {
    return OrdersProduct::select('cat.id', 'cat.title AS category', DB::raw('COUNT(cat.title) as count'))
        ->join('products AS p', 'orders_products.product_id', 'p.id')
        ->join('categories AS sub', 'p.category_id', 'sub.id')
        ->join('categories AS cat', 'sub.category_id', 'cat.id')
        ->groupBy('category', 'cat.id')->orderByDesc('count')->limit(5)
        ->get()->toArray();
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

function cartCount(): string {
    if(Auth::check()) {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
    } else if(!empty(Session::get('session_id'))) {
        $count = Cart::where('session_id', Session::get('session_id'))->sum('quantity');
    } else {
        $count = 0;
    }

    return $count;
}

/**
 * @throws JsonException
 */
function cartTotal(): string {
    $total = 0;
    $cart = Cart::cartItems();

    foreach($cart as $item) {
        $details = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR);
        $discountPrice = Cart::getVariationPrice($item['product_id'], $details)['discount_price'];
        $total += ($discountPrice * $item['quantity']);
    }

    return currencyFormat($total);
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
        'Variation' => Variation::class,
        'Variation\'s option' => VariationsOption::class,
        'Product\'s Image' => productsImage::class,
    };
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
