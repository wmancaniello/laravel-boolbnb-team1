<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlatRequest extends FormRequest
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
            'title' => 'required|min:5',
            'max_guests' => 'required|numeric|integer|min:1',
            'rooms' => 'required|numeric|integer|min:1',
            'beds' => 'required|numeric|integer|min:1',
            'bathrooms' => 'required|numeric|integer|min:1',
            'meters_square' => 'required|numeric|integer|min:1',
            'address' => 'required|min:5',
            'meters_square' => 'required|numeric|integer|min:1',
            'latitude' => 'required|numeric|min:1',
            'longitude' => 'required|numeric|min:1',
            'main_img' => 'required|image',
            'visible' => 'required|in:si,no',
            'description' => 'required|min:20',
            'services' => 'nullable|exists:services,id',
            
            
        ];
    }
}
