<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'email.required' => 'Email est obligatoire',
            'password.requird' => 'Mot de passe est obligatoire',
    
        ];
    }
}
