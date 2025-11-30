<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255|unique:product_categories,name',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'parent_id' => 'Kategori Induk',
            'image' => 'Foto',
            'name' => 'Nama Kategori',
            'tagline' => 'Tagline',
            'description' => 'Deskripsi',
        ];
    }
}
