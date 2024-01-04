<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'product.title' => 'required|string',
            'product.price' => 'required',
            'product.description' => 'required',
            'status' => 'required',
            'product.categories' => 'required',
            'product.content' => 'required',
            'product.thumbnail' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'product.title.required' => 'Pole tytuł jest wymagane',
            'product.price.required' => 'Pole cena jest wymagane',
            'product.description.required' => 'Pole opis jest wymagane',
            'status.required' => 'Pole status jest wymagane',
            'product.categories.required' => 'Kategorie są wymagane',
            'product.content.required' => 'Sczegółowy opis produktu jest wymagany',
            'product.thumbnail.required' => 'Miniaturka jest wymagana',
        ];
    }
}
