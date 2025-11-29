<?php

namespace Database\Seeders;

use App\Helper\ImageHelpers\ImageHelper;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories =  [
            [
                'name' => 'Elektronik',
                'tagline' => 'Temukan berbagai produk elektronik terbaik',
                'description' => 'Kategori produk elektronik seperti laptop, smartphone, dan lainnya',
                'children' => [
                    [
                        'name' => 'Smartphone',
                        'tagline' => 'Smart phone terbaru dengan teknologi canggih',
                        'description' => 'berbagai merk smartphone yang mantap',
                    ],
                    [
                        'name' => 'Laptop',
                        'tagline' => 'Smart phone terbaru dengan teknologi canggih',
                        'description' => 'Koleksi laptop untuk gaming, kerja, dan kebutuhan sehari-hari',
                    ],
                    [
                        'name' => 'Aksesoris Gadget',
                        'tagline' => 'Lengkapi gadget Anda dengan aksesoris terbaik',
                        'description' => 'Berbagai aksesoris untuk smartphone dan laptop',
                    ],
                ]
            ],
            [
                'name' => 'Fashion',
                'tagline' => 'Temukan berbagai fashion  terbaik',
                'description' => 'Kategori produk fashion untuk pria dan wanita',
                'children' => [
                    [
                        'name' => 'Pakaian pria',
                        'tagline' => 'Koleksi pakaian pria terkini',
                        'description' => 'berbagai merk pakaian pria yang mantap',
                    ],
                    [
                        'name' => 'Pakaian wanita',
                        'tagline' => 'Koleksi pakaian wanita terkini',
                        'description' => 'Koleksi pakaian wanita',
                    ],
                ]
            ],
            [
                'name' => 'Kesehatan & kecantikan',
                'tagline' => 'Produk kesehatan dan kecantikan terbaik',
                'description' => 'Kategori produk kesehatan untuk pria dan wanita',
                'children' => [
                    [
                        'name' => 'Skincare',
                        'tagline' => 'Produk perawatan kulit terbaik',
                        'description' => 'berbagai merk produk pakaian kulit pria yang mantap',
                    ],
                    [
                        'name' => 'Suplemen',
                        'tagline' => 'Suplemen kesehatan berkualitas',
                        'description' => 'Berbagai suplemen untuk menjaga kesehatan tubuh',
                    ],
                ]
            ]
        ];

        $imageHelper = new ImageHelper;

        foreach ($categories as $category) {
            $parent = ProductCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'tagline' => $category['tagline'],
                'description' => $category['description'],
                'image' => $imageHelper->storeAndResizeImage(
                    $imageHelper->createDummyImageWithTextSizeAndPosition(250, 250, 'center', 'center', 'random', 'medium'),
                    'product-category',
                    250,
                    250
                ),
                'parent_id' => null,
            ]);

            foreach ($category['children'] as $child) {
                ProductCategory::create([
                    'name' => $child['name'],
                    'slug' => Str::slug($child['name']),
                    'tagline' => $child['tagline'],
                    'description' => $child['description'],
                    'image' => $imageHelper->storeAndResizeImage(
                        $imageHelper->createDummyImageWithTextSizeAndPosition(250, 250, 'center', 'center', 'random', 'medium'),
                        'product-category',
                        250,
                        250
                    ),
                    'parent_id' => $parent->id,
                ]);
            }
        }


    }
}
