<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrdersProduct;
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
        $orderIds = Order::pluck('id')->toArray();

        return [
            'order_id' => $this->faker->randomElement($orderIds),
            'product_id' => $this->faker,
            'details' => $this->faker,
            'quantity' => $this->faker,
            'final_unit_price' => $this->faker,
            'created_at' => $this->faker,
        ];
    }
}
