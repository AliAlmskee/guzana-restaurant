<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'array|size:2',
            'name.de' => 'string|max:255',
            'name.ar' => 'string|max:255',
            'description' => 'array|size:2',
            'description.de' => 'string|max:1000',
            'description.ar' => 'string|max:1000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB 
            'category_id' => 'exists:categories,id'
        ];
    }
}
