<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function showCoupons(): Factory|View|Application {
        $coupons = Coupon::latest()->get()->toArray();

        return view('Admin.Coupons.list')
            ->with(compact('coupons'));
    }

    public function getCreateUpdate(Request $request, $id = null) {
        if($request->isMethod('GET')) {
            $sections = Category::sections();
            $users = User::all();

            if(!$id) {
                $title = "Create";

                return view('Admin.Coupons.view')
                    ->with(compact('title', 'sections', 'users'));
            }

            $title = "Update";
            $coupon = Coupon::find($id);

            return view('Admin.Coupons.view')
                ->with(compact('title', 'sections', 'users', 'coupon'));
        }
        $data = $request->all();

        $request->validate([
            'code' => 'bail|sometimes|exclude_if:option,Automatic|required_if:option,Manual|alpha_num|unique:coupons',
            'categories' => 'bail|required|array',
            'users' => 'bail|array',
            'coupon_type' => 'bail|required|alpha',
            'amount_type' => 'bail|required|alpha',
            'amount' => 'bail|required|numeric',
            'expiry' => 'bail|required|date',
        ], [
            'code.prohibited_unless' => 'You can\'t put a code if the option is Automatic'
        ]);

        $users = "";
        if(isset($data['users'])) {
            $users = implode(',', $data['users']);
        }

        $categories = implode(',', $data['categories']);

        $title = DB::transaction(function() use ($data, $users, $categories, $id, $request) {
            if($request->isMethod('PUT')) {
                Coupon::where('id', $id)->update([
                    'categories' => $categories,
                    'users' => $users,
                    'coupon_type' => $data['coupon_type'],
                    'amount_type' => $data['amount_type'],
                    'amount' => $data['amount'],
                    'expiry' => $data['expiry'],
                ]);

                return "Updated";
            }

            $code = ($data['code']) ? : Str ::random(7);

            Coupon::create([
                'option' => $data['option'],
                'code' => $code,
                'categories' => $categories,
                'users' => $users,
                'coupon_type' => $data['coupon_type'],
                'amount_type' => $data['amount_type'],
                'amount' => $data['amount'],
                'expiry' => $data['expiry'],
            ]);

            return "Created";
        });

        $message = "Coupon $title";
        return redirect(route('admin.coupons'))
            ->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }
}
