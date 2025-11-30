<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string|unique:product_categories,name,'.$this->route('product_category'),
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'Foto',
            'name' => 'Nama Kategori',
            'tagline' => 'Tagline',
            'description' => 'Deskripsi',
        ];
    }
}
