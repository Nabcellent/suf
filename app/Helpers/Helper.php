<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\Pure;

function cartCount(): string
{
    if(Auth::check()) {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
    } else if(!empty(Session::get('session_id'))) {
        $count = Cart::where('session_id', Session::get('session_id'))->sum('quantity');
    } else {
        $count = "";
    }

    return $count;
}

/**
 * @throws JsonException
 */
function cartTotal(): string
{
    $total = 0;
    $cart = Cart::cartItems();

    foreach($cart as $item) {
        $details = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR);
        $discountPrice = Cart::getVariationPrice($item['product_id'], $details)['discount_price'];
        $total += ($discountPrice * $item['quantity']);
    }

    return currencyFormat($total);
}

#[Pure] function currencyFormat($number): string
{
    return number_format((float)$number, 2);
}
