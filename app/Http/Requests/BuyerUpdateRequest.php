<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyerUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'profile_picture' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'phone_number' => 'required|string|digits_between:8,14',
        ];
    }

    public function attributes(): array
    {
        return [
            'profile_picture' => 'Avatar',
            'phone_number' => 'Nomor HP',
        ];
    }
}
