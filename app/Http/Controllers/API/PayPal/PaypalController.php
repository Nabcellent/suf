<?php

namespace App\Http\Controllers\API\PayPal;

use AmrShawky\Currency;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{
    /**
     * @throws Exception
     */
    public function show(): View|Factory|Redirector|Application|RedirectResponse {
        if(session::has('orderId')) {
            $data['usd'] = Currency::convert()
                ->from('KES')
                ->to('USD')
                ->amount(currencyToFloat(session('grandTotal')))
                ->round(2)
                ->get();

            return view('API.paypal', $data);
        }

        return redirect('/cart');
    }

    public function updateOrderStatus(Request $request, $id) {
        $order = Order::find($id);
        $order->status = $request->input('status');
        $order->save();
    }
}
