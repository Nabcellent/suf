<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrdersProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        return [
            'order_id' => Order::factory(),
            'product_id' => $this->faker->randomElement(Product::take(20)->pluck('id')),
            'details' => $this->faker->randomElement(Attribute::pluck('values')),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'is_ready' => $this->faker->boolean(30),
        ];
    }
}
