<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    // Détermine si l'utilisateur est autorisé à faire cette requête
    public function authorize(): bool
    {
        return true; // Autoriser tout le monde à utiliser le formulaire
    }

    // Définir les règles de validation
    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:15',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ];
    }

    // Personnaliser les messages d'erreur si besoin
    public function messages(): array
    {
        return [
            'name.required'    => 'Le nom est obligatoire.',
            'email.required'   => 'L\'email est obligatoire.',
            'email.email'      => 'L\'email doit être valide.',
            'message.required' => 'Le message est obligatoire.',
        ];
    }
}
