<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            if ($product->productImages()->count() === 0) {
                // Create a thumbnail
                ProductImage::factory()->thumbnail()->create([
                    'product_id' => $product->id,
                ]);

                // Create additional images
                ProductImage::factory()->count(rand(1, 3))->create([
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
