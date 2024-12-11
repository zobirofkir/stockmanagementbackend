<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "title" => "required|string|max:255|min:3",
            "images" => "required|array|min:1",
            "images.*" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "description" => "required|string|max:255|min:3",
            "price" => "required|numeric|min:0",
            "quantity" => "required|numeric|min:0",
        ];
    }
}