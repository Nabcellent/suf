<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\County;
use App\Models\DeliveryAddress;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function checkout(): Factory|View|Application
    {
        $cart = Cart::cartItems();
        $addresses = DeliveryAddress::deliveryAddresses();

        return view('checkout')->with(compact('cart', 'addresses'));
    }

    public function deliveryAddress(Request $req, $id) {
        if(is_null($id)) {
            $title = "Add Address";
        } else {
            $title = "Edit Address";
        }

        $counties = County::where('status', 1)->get()->toArray();

        return view('delivery_address')->with(compact('title', 'counties'));
    }
}
