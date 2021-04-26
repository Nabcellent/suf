<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = Category::whereNotNull('category_id')->pluck('id')->toArray();
        $sellers = Admin::where('type', 'Seller')->pluck('user_id')->toArray();
        $brands = Brand::pluck('id')->toArray();

        return [
            'category_id' => $this->faker->randomElement($categories),
            'seller_id' => $this->faker->randomElement($sellers),
            'brand_id' => $this->faker->randomElement($brands),
            'title' => $this->faker->word,
            'main_image' => $this->faker->unique()->image(public_path('images/products'), 600, 480, null, false),
            'keywords' => $this->faker->sentence,
            'description' => $this->faker->text,
            'label' => $this->faker->randomElement(['New', 'Sale']),
            'base_price' => $this->faker->randomFloat(2, 0, 5000),
            'is_featured' => $this->faker->randomElement(['Yes', 'No']),
            'discount' => $this->faker->numberBetween(0, 99),
            'created_at' => $this->faker->dateTimeBetween(now()->subDays(6), now())
        ];
    }
}
