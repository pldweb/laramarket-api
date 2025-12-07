<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        // Indonesian product name generation
        $prefixes = ['Baru', 'Promo', 'Terlaris', 'Original', 'Murah', 'Berkualitas', 'Diskon', 'Spesial'];
        $nouns = ['Laptop', 'Smartphone', 'Meja', 'Kursi', 'Sepatu', 'Baju', 'Celana', 'Tas', 'Jam Tangan', 'Kamera', 'Headphone', 'Mouse', 'Keyboard', 'Monitor', 'Printer', 'Speaker', 'Powerbank', 'Charger', 'Kabel Data', 'Casing', 'Televisi', 'Kulkas', 'Mesin Cuci', 'AC', 'Kipas Angin', 'Blender', 'Rice Cooker', 'Setrika', 'Kompor', 'Panci'];
        $adjectives = ['Gaming', 'Kantor', 'Sekolah', 'Anak', 'Pria', 'Wanita', 'Sport', 'Casual', 'Formal', 'Elegan', 'Modern', 'Klasik', 'Minimalis', 'Premium', 'Eksklusif', 'Canggih', 'Kuat', 'Tahan Lama', 'Hemat Energi', 'Multifungsi'];

        $name = $this->faker->randomElement($prefixes).' '.$this->faker->randomElement($nouns).' '.$this->faker->randomElement($adjectives);

        // Indonesian description
        $descriptions = [
            'Produk ini sangat berkualitas dan awet.',
            'Dibuat dengan bahan pilihan terbaik.',
            'Cocok untuk penggunaan sehari-hari.',
            'Desain modern dan elegan.',
            'Garansi resmi 1 tahun.',
            'Stok terbatas, segera beli sebelum kehabisan.',
            'Pengiriman cepat dan aman.',
            'Harga terjangkau dengan kualitas premium.',
            'Sangat direkomendasikan untuk anda.',
            'Barang original 100%.',
            'Nyaman digunakan dalam jangka waktu lama.',
            'Mudah dibersihkan dan dirawat.',
        ];

        $description = implode(' ', $this->faker->randomElements($descriptions, rand(2, 5)));

        $conditions = ['new', 'second'];

        return [
            'store_id' => Store::factory(),
            'product_category_id' => ProductCategory::inRandomOrder()->first()->id ?? ProductCategory::factory(),
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::random(5),
            'description' => $description,
            'condition' => $this->faker->randomElement($conditions),
            'price' => $this->faker->randomFloat(2, 10000, 10000000),
            'weight' => $this->faker->randomFloat(2, 0.1, 10),
            'stock' => $this->faker->numberBetween(1, 100),
        ];
    }
}
