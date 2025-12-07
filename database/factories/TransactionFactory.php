<?php

namespace Database\Factories;

use App\Models\Buyer;
use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'buyer_id' => Buyer::factory(),
            'store_id' => Store::factory(),
            'address' => $this->faker->address(),
            'address_id' => $this->faker->uuid(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'shipping' => $this->faker->randomElement(['JNE', 'J&T', 'Sicepat']),
            'shipping_type' => $this->faker->randomElement(['Regular', 'Express']),
            'shipping_cost' => $this->faker->randomFloat(2, 10000, 50000),
            'tracking_number' => $this->faker->uuid(),
            'delivery_proof' => null,
            'delivery_status' => $this->faker->randomElement(['pending', 'processing', 'delivering', 'completed']),
            'tax' => $this->faker->randomFloat(2, 1000, 10000),
            'grand_total' => $this->faker->randomFloat(2, 100000, 1000000),
            'payment_status' => $this->faker->randomElement(['unpaid', 'paid']),
        ];
    }
}
