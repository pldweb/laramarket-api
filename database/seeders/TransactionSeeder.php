<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\ProductReview;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $buyers = Buyer::all();
        $stores = Store::all();

        if ($buyers->isEmpty()) {
            $buyers = Buyer::factory()->count(10)->create();
        }
        if ($stores->isEmpty()) {
            $stores = Store::factory()->count(10)->create();
        }

        Transaction::factory()->count(50)->create(function () use ($buyers, $stores) {
            return [
                'buyer_id' => $buyers->random()->id,
                'store_id' => $stores->random()->id,
            ];
        })->each(function ($transaction) {
            // Create details
            $details = TransactionDetail::factory()->count(rand(1, 3))->create([
                'transaction_id' => $transaction->id,
            ]);

            // Create reviews for some details if transaction is completed
            if ($transaction->delivery_status === 'completed') {
                foreach ($details as $detail) {
                    if (rand(0, 1)) {
                        ProductReview::factory()->create([
                            'transaction_id' => $transaction->id,
                            'product_id' => $detail->product_id,
                        ]);
                    }
                }
            }
        });
    }
}
