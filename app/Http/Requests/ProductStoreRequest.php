<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'store_id' => 'required|exists:stores,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'condition' => 'required|string',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'product_images' => 'required|array|min:1',
            'product_images.*.image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'product_images.*.is_thumbnail' => 'boolean|required',
        ];
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'Toko',
            'product_category_id' => [
                'required',
                'exists:product_categories,id',
                function ($attribute, $value, $fail) {
                    $category = ProductCategory::find($value);
                    if ($category && $category->parent_id === null) {
                        $fail('Kategori produk tidak memiliki kategori induk');
                    }
                },
            ],
            'name' => 'Nama',
            'description' => 'Deskripsi',
            'condition' => 'Kondisi',
            'price' => 'Harga',
            'weight' => 'Berat',
            'stock' => 'Stok',
            'product_images.*.images' => 'Gambar',
            'product_images.*.is_thumbnail' => 'Gambar Utama',
        ];
    }
}
