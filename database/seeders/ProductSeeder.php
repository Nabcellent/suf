<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Product::truncate();

        Product::insert([
            [
                "category_id" => 3,
                "seller_id" => 2,
                "title" => 'Sense Tv',
                "main_image" => "boys-Puffer-Coat-With-Detachable-Hood-1.jpg",
                "keywords" => "Some words",
                "description" => "Smart TV 50",
                "label" => "new",
                "base_price" => 1600,
                "sale_price" => 0,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ], [
                "category_id" => 4,
                "seller_id" => 2,
                "title" => 'Samsung mobile',
                "main_image" => "women-diamond-heart-ring-3.jpg",
                "keywords" => "Some words",
                "description" => "Smart phone with 4GB RAM and 128GB ROM",
                "label" => "sale",
                "base_price" => 300,
                "sale_price" => 0,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ], [
                "category_id" => 5,
                "seller_id" => 2,
                "title" => 'Oppo Mobile',
                "main_image" => "photo_2021-01-04_14-26-25.jpg",
                "keywords" => "Some words",
                "description" => "Smart phone with 8GB RAM and 256GB ROM",
                "label" => "new",
                "base_price" => 2100,
                "sale_price" => 1800,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
    }
}
