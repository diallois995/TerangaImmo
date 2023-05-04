<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnonceFormRquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titre' => 'required|min:3',
            'montant' => 'required|numeric',
            'categorie' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'titre.required' => 'Le titre est requis',
            'titre.min' => 'La taille minimale du titre est de :min caracteres',

            'montant.required' => 'Le montant est requis',
            'montant.numeric' => 'Le montant doit etre un numérique',

            'categorie.required' => 'La catégorie est requis',
        ];
    }
}
