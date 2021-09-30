<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Variation;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void {
        $this->call([
            UserSeeder::class,
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
            CmsPageSeeder::class,
            PermissionSeeder::class,
            ReviewSeeder::class,
        ]);

        $this->command->getOutput()->progressStart(150);
        User::factory()->count(20)
            ->hasAddresses(1)
            ->hasPhones(1)
            ->create()->each(function($user) {
                if($user->is_admin === 1) {
                    Admin::factory()->create([
                        'user_id' => $user->id
                    ]);
                }
                $this->command->getOutput()->progressAdvance();
            });
        Product::factory()->count(50)->create()->each(function($product) {
            if(mt_rand(0, 10) > 5) {
                $options = Attribute::all()->map(function($item) {
                    $this->command->getOutput()->progressAdvance();
                    return collect($item->values)->map(function($value) {
                        $this->command->getOutput()->progressAdvance();
                        return [$value => [
                            'stock' => Factory::create()->numberBetween(0, 100),
                            'extra_price' => mt_rand(0, 5),
                            'image' => '',
                            'status' => true
                        ]];
                    })->collapse();
                })->toArray();

                foreach(Factory::create()->randomElements($options, mt_rand(1, 3)) as $key => $option) {
                    $this->command->getOutput()->progressAdvance();

                    Variation::factory()->create([
                        'product_id' => $product->id,
                        'attribute_id' => Attribute::inRandomOrder()->first()->id,
                        'options' => $option
                    ]);
                }
            }

            $this->command->getOutput()->progressAdvance();
        });
        Order::factory()->count(100)->hasOrderProducts(mt_rand(1, 3))->create();

        $this->command->getOutput()->progressFinish();
    }
}
