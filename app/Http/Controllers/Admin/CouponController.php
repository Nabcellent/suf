<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        if($request->isMethod('PUT')) {
            $coupon = Coupon::find($id);
        }

        DB::transaction(function() use ($request) {
            Coupon::insert([
                'code' => $request->code,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        });

        return redirect(route('admin.coupons'));
    }
}
