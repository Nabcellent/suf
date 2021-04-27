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
                "category_id" => 9,
                "seller_id" => 2,
                "brand_id" => 1,
                "title" => 'Puffer Coat',
                "main_image" => "boys-Puffer-Coat-With-Detachable-Hood-1.jpg",
                "keywords" => "Some words",
                "description" => "Smart TV 50",
                "label" => "new",
                "base_price" => 1600,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ], [
                "category_id" => 10,
                "seller_id" => 2,
                "brand_id" => 2,
                "title" => 'Diamond Ring',
                "main_image" => "women-diamond-heart-ring-3.jpg",
                "keywords" => "Some words",
                "description" => "Smart phone with 4GB RAM and 128GB ROM",
                "label" => "sale",
                "base_price" => 300,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ], [
                "category_id" => 11,
                "seller_id" => 2,
                "brand_id" => 3,
                "title" => 'Adidas Loafers',
                "main_image" => "Man-Adidas-Suarez-Slop-On-1.jpg",
                "keywords" => "Some words",
                "description" => "Smart phone with 8GB RAM and 256GB ROM",
                "label" => "new",
                "base_price" => 2100,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
    }
}
