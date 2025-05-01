<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|array|size:2',
            'name.de' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'description' => 'required|array|size:2',
            'description.de' => 'required|string|max:1000',
            'description.ar' => 'required|string|max:1000',
            'photo' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}