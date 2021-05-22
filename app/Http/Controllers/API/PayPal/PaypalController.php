<?php

namespace App\Http\Controllers\API\PayPal;

use AmrShawky\Currency;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
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

    public function updateOrderStatus(Request $request, $id) {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();
    }
}
