<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $reviews = [
            [
                'user_id' => 2,
                'product_id' => 1,
                'review' => 'Very good product',
                'rating' => 4
            ], [
                'user_id' => 2,
                'product_id' => 2,
                'review' => 'Excellent product',
                'rating' => 5
            ], [
                'user_id' => 1,
                'product_id' => 1,
                'review' => 'Poor product, very bad',
                'rating' => 1
            ]
        ];

        Review::insert($reviews);
    }
}
