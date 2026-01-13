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
            'nom'=>'required',
            'description'=>'nullable|min:15',
            'prix'=>'required|numeric|min:0',
            'image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'stock'=>'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ];
    }
}
