<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;
    private static int $orderNo = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        $user = User::where('is_admin', '<>', 7)->with('primaryPhone')->inRandomOrder()->first();

        $phone = $this->faker->randomElement([
            11 . $this->faker->unique()->numerify('#######'),
            7 . $this->faker->unique()->numerify('########')
        ]);

        return [
            'user_id' => $user->id,
            'address_id' => Address::inRandomOrder()->value('id'),
            'order_no' => "SUF-" . self::$orderNo++,
            'phone' => $phone,
            'payment_method' => $this->faker->randomElement(['cash', 'm-pesa', 'paypal']),
            'payment_type' => $this->faker->randomElement(['on-delivery', 'instant']),
            'total' => $this->faker->randomFloat(2, 0, 10000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'created_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
