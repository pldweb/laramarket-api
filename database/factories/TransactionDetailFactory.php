<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionDetail>
 */
class TransactionDetailFactory extends Factory
{
    protected $model = TransactionDetail::class;

    public function definition(): array
    {
        $qty = $this->faker->numberBetween(1, 5);
        $price = $this->faker->randomFloat(2, 10000, 1000000);

        return [
            'transaction_id' => Transaction::factory(),
            'product_id' => Product::factory(),
            'qty' => $qty,
            'subtotal' => $price * $qty,
        ];
    }
}
