<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\Pure;

function sections() {
    return Category::sections();
}
function latestFour(): array {
    return Product::products()->where('products.status', 1)
        ->orderByDesc('products.created_at')->limit(4)->get()->toArray();
}
function trendingCategories(): Collection|array {
    return Product::all();
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

function currencyToFloat($currency): float
{ return (float)preg_replace('/[^\d.]/', '', $currency); }

function mapped_implode($glue, $array, $symbol = '='): string
{
    return implode($glue, array_map(
            static function($k, $v) use($symbol) {
                return $k . $symbol . $v;
            },
            array_keys($array),
            array_values($array)
        )
    );
}

function accessDenied(): Redirector|Application|RedirectResponse {
    return redirect('/')->with('alert', [
        'type' => 'danger',
        'intro' => 'Sorry!',
        'message' => "Access Denied",
        'duration' => 7
    ]);
}