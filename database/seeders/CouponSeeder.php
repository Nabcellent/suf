<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::truncate();

        Coupon::insert([
            'option' => 'Manual',
            'code' => 'test10',
            'categories' => '1,2',
            'user' => 'michael.nabangi@strathmore.edu,miguelnabz@gmail.com',
            'coupon_type' => 'Single',
            'amount_type' => 'Percent',
            'amount' => '10',
            'expiry' => Carbon::tomorrow(),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }
}
