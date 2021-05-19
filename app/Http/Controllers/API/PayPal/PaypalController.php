<?php

namespace App\Http\Controllers\API\PayPal;

use AmrShawky\Currency;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{
    public function show() {
        if(session::has('orderId')) {
            //  Empty User Cart
            Cart::where('user_id', Auth::id())->delete();

            $usd = Currency::convert()
                ->from('KES')
                ->to('USD')
                ->amount(currencyToFloat(session('grandTotal')))
                ->round(2)
                ->get();

            return view('API.paypal', compact('usd'));
        }

        return redirect('/cart');
    }

    public function showCart(): Redirector|Application|RedirectResponse {
        session::forget(['grandTotal', 'orderId', 'couponId', 'couponDiscount']);

        return redirect('cart');
    }
}
