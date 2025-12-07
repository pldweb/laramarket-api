<?php

namespace Database\Factories;

use App\Helper\ImageHelpers\ImageHelper;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);
        $imageHelper = new ImageHelper;

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'image' => $imageHelper->storeAndResizeImage(
                $imageHelper->createDummyImageWithTextSizeAndPosition(600, 600, 'center', 'center', 'random', 'large'),
                'category',
                400,
                400
            ),
            'tagline' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
