<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\StoreBalance;
use Illuminate\Database\Seeder;

class StoreBalanceSeeder extends Seeder
{
    public function run(): void
    {
        $stores = Store::all();

        foreach ($stores as $store) {
            if (! $store->storeBalance) {
                StoreBalance::factory()->create([
                    'store_id' => $store->id,
                ]);
            }
        }
    }
}
