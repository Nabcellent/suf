<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    //
    public function applyCoupon(Request $req) {
        if($req->isMethod('POST')) {
            $code = $req->code;
            //  Exists
            if(Coupon::where('code', $code)->doesntExist()) {
                $message = "Invalid Coupon Code 🤡. Try a real one.";
                return back()->with('alert', ['type' => 'warning', 'intro' => 'Caapp!', 'message' => $message, 'duration' => 7]);
            }

            $coupon = Coupon::where('code', $code)->first()->toArray();

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
            $cartTotal = (float)preg_replace('/[^\d.]/', '', cartTotal());
            if($coupon['amount_type'] === 'Fixed') {
                $discount = $coupon['amount'];
            } else {
                $discount = $cartTotal * ($coupon['amount'] / 100);
            }

            $grandTotal = $cartTotal - $discount;

            //  Add to session variable
            Session::put('couponAmount', currencyFormat($discount));
            Session::put('couponCode', $code);
            Session::put('grandTotal', currencyFormat($grandTotal));

            $message = "Coupon Applied. 🥳";
            return back()->with('alert', ['type' => 'success', 'intro' => 'Yeessir!', 'message' => $message, 'duration' => 7]);
        }

        $message = "Access Denied!";
        return redirect('/')->with('alert', ['type' => 'danger', 'intro' => 'Warning!', 'message' => $message, 'duration' => 7]);
    }
}
