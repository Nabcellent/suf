<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            PhoneSeeder::class,
            //AddressSeeder::class,
            AttributeSeeder::class,
            CategorySeeder::class,
            //ProductSeeder::class,
            //VariationSeeder::class,
            //VariationsOptionSeeder::class,
            //ProductsImageSeeder::class,
            BrandSeeder::class,
            AdBoxSeeder::class,
            BannerSeeder::class,
            //CouponSeeder::class,
            PolicySeeder::class,
        ]);
    }
}
//php artisan migrate:fresh --seed
