<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\Factory;

class VariationFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Variation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        return [
            'product_id' => Product::factory(),
            'attribute_id' => Attribute::factory(),
        ];
    }
}
