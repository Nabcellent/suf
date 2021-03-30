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
                "section_id" => null,
                "category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Ladies",
                "section_id" => null,
                "category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Exclusive",
                "section_id" => null,
                "category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "T-Shirt",
                "section_id" => 1,
                "category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Coats",
                "section_id" => 1,
                "category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Coats",
                "section_id" => 2,
                "category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Accessories",
                "section_id" => 2,
                "category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Shoes",
                "section_id" => 1,
                "category_id" => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "Puffer Coats",
                "section_id" => 1,
                "category_id" => 5,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "rings",
                "section_id" => 2,
                "category_id" => 7,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "title" => "loafers",
                "section_id" => 1,
                "category_id" => 8,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
