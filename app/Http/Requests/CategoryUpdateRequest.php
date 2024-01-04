<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'category.name' => 'required|string',
            'category.active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'category.name.required' => 'Pole nazwa jest wymagane',
            'category.name.boolean' => 'Pole musi mieć wartość true/false',
        ];
    }
}
