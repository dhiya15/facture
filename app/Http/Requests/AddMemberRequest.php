<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMemberRequest extends FormRequest
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
            'full_name'=>'required|string',
            'email'=>'nullable|string|email|unique:members',
            'phone'=>'required|string|unique:members|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'birth_date'=>'nullable|date',
            'profession'=>'nullable|string',
            'image'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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
            'full_name.required' => 'Nom est obligatoire',
            'email.email' => 'Email est invalide',
            'email.unique' => 'Email est déja utilisé',
            'phone.required' => 'Téléphone est obligatoire',
            'phone.unique' => 'Téléphone est existe déja',
            'phone.regex' => 'Téléphone est invalide',
            'phone.min' => 'Téléphone doit etre 10 caractères au minimum',
            'image.image' => 'Le logo normalement est une image',
            'image.mimes' => 'Extention non acceptable',
            'image.max' => 'La taille maximal est 2 MO'
        ];
    }
}
