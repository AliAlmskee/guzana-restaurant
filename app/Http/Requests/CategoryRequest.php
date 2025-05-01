<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|array|size:2',
            'name.de' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'name.*' => 'string|max:255', // Validate all array values
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.array' => 'The name must be an object with de and ar properties.',
            'name.size' => 'The name must contain exactly German and Arabic translations.',
            'name.de.required' => 'The German name is required.',
            'name.ar.required' => 'The Arabic name is required.',
            'name.*.string' => 'Each name must be a string.',
            'name.*.max' => 'Each name may not be greater than 255 characters.',
        ];
    }
}