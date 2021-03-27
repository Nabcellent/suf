<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Category::truncate();

        Category::insert([
            [
                "title" => "Gents",
                "category_id" => null,
                "sub_category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Ladies",
                "category_id" => null,
                "sub_category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Exclusive",
                "category_id" => null,
                "sub_category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "T-Shirt",
                "category_id" => 1,
                "sub_category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Coats",
                "category_id" => 2,
                "sub_category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Shoes",
                "category_id" => 1,
                "sub_category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Gumboots",
                "category_id" => 1,
                "sub_category_id" => 6,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Sleeveless",
                "category_id" => 1,
                "sub_category_id" => 4,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
