<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAdminRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|string|email|unique:admins',
            'username'=>'required|string|unique:admins',
            'phone'=>'required|string|unique:admins|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password'=>'required|min:8'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'Nom est obligatoire',
            'last_name.required' => 'Prénom est obligatoire',
            'email.required' => 'Email est obligatoire',
            'email.email' => 'Email est invalide',
            'email.unique' => 'Email est déja utilisé',
            'username.required' => "Nom d'utilisateur est obligatoire",
            "username.unique" => "Nom d'utilisateur est déja utilisé",
            'phone.required' => 'Téléphone est obligatoire',
            'phone.unique' => 'Téléphone est existe déja',
            'phone.regex' => 'Téléphone est invalide',
            'phone.min' => 'Téléphone doit etre 10 caractères au minimum',
            'password.required' => 'Mot de passe est obligatoire',
            'password.min' => 'Un mot de passe doit etre 8 caractères au minimum',
        ];
    }
}
