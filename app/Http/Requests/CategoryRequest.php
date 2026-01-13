<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'libelle' => 'required|string|min:3|max:50|unique:categories,libelle',
        ];
    }


        public function messages(): array
        {
            return [
                'libelle.required' => 'Le libellé est obligatoire',
                'libelle.min' => 'Le libellé doit contenir au moins 3 caractères',
                'libelle.max' => 'Le libellé ne peut pas dépasser 50 caractères',
                'libelle.unique' => 'Cette catégorie existe déjà',
            ];

        }

}
