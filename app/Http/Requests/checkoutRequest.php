<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class checkoutRequest extends FormRequest
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
            'adresse_livraison' => 'required|string|min:10',
            'telephone' => 'required|string',
            'ville' => 'required|string',
            'remarques' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'adresse_livraison.required' => 'L\'adresse de livraison est obligatoire',
            'adresse_livraison.min' => 'L\'adresse doit contenir au moins 10 caractères',
            'telephone.required' => 'Le numéro de téléphone est obligatoire',
            'ville.required' => 'La ville est obligatoire'
        ];
    }
}
