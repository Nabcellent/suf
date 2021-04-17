<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    //
    public function applyCoupon(Request $req): Redirector|RedirectResponse|Application
    {
        if($req->isMethod('POST')) {
            $code = $req->code;
            //  Exists
            if(Coupon::where('code', $code)->doesntExist()) {
                $message = "Invalid Coupon Code 🤡. Try a real one.";
                return back()->with('alert', ['type' => 'warning', 'intro' => 'Caapp!', 'message' => $message, 'duration' => 7]);
            }

            $coupon = Coupon::where('code', $code)->first()->toArray();

            //  User has already used this coupon?
            if($coupon['coupon_type'] === 'Single' && Order::where(['user_id' => Auth::id(), 'coupon_id' => $coupon['id']])->exists()) {
                $message = "This was a one time coupon which you have already used. 🌚";
                return back()->with('alert', ['type' => 'info', 'intro' => 'Oops!', 'message' => $message, 'duration' => 7]);
            }

            //  Active / Inactive
            if(!$coupon['status']) {
                $message = "This Coupon is inactive. ☹";
                return back()->with('alert', ['type' => 'info', 'intro' => 'Sorry!', 'message' => $message, 'duration' => 7]);
            }

            //  Expired?
            $expiryDate = $coupon['expiry'];
            if(Carbon::now()->diffInDays($expiryDate, false) < 0) {
                $message = "This Coupon has already expired. ☹";
                return back()->with('alert', ['type' => 'info', 'intro' => 'Sorry!', 'message' => $message, 'duration' => 7]);
            }

            //  Check if Coupon is applicable to current user
            if(!empty($coupon['users'])) {
                $users = explode(',', $coupon['users']);
                if(!in_array(Auth::user()->email, $users, true)) {
                    $message = "This Coupon isn't applicable to you. 😬";
                    return back()->with('alert', ['type' => 'info', 'intro' => 'Sorry!', 'message' => $message, 'duration' => 7]);
                }
            }

            //  Check Categories
            $categories = array_map('intval', explode(',', $coupon['categories']));
            $cartItems = Cart::cartItems();

            foreach($cartItems as $item) {
                if(!in_array($item['product']['category_id'], $categories, true)) {
                    $message = "This Coupon isn't applicable to the items in your cart. ☹";
                    return back()->with('alert', ['type' => 'info', 'intro' => 'Sorry!', 'message' => $message, 'duration' => 7]);
                }
            }


            //  Apply Coupon
            $cartTotal = currencyToFloat(cartTotal());
            if($coupon['amount_type'] === 'Fixed') {
                $discount = $coupon['amount'];
            } else {
                $discount = $cartTotal * ($coupon['amount'] / 100);
            }

            $grandTotal = $cartTotal - $discount;

            //  Add to session variable
            Session::put('couponDiscount', currencyFormat($discount));
            Session::put('couponId', $coupon['id']);
            Session::put('grandTotal', currencyFormat($grandTotal));

            $message = "Coupon Applied. 🥳";
            return back()->with('alert', ['type' => 'success', 'intro' => 'Yeessir!', 'message' => $message, 'duration' => 7]);
        }

        return accessDenied();
    }
}
