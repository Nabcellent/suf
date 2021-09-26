<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void {
        $this->call([
            /*UserSeeder::class,
            AdminSeeder::class,
            PhoneSeeder::class,
            AddressSeeder::class,
            AttributeSeeder::class,
            BannerSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            VariationSeeder::class,
            ProductsImageSeeder::class,
            BrandSeeder::class,
            CouponSeeder::class,
            OrderSeeder::class,
            PolicySeeder::class,
            CmsPageSeeder::class,*/
            PermissionSeeder::class,
        ]);

        /*User::factory()->count(20)
            ->hasAddresses(1)
            ->hasPhones(1)
            ->create()->each(function($user) {
                if($user->is_admin === 1) {
                    Admin::factory()->create([
                        'user_id' => $user->id
                    ]);
                }
            });*/
        //Product::factory()->count(10)->create();
//        Order::factory()->count(13)->create();
    }
}
