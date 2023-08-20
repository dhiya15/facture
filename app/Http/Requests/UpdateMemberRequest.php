<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
            'email'=>'nullable|string|email',
            'phone'=>'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'birth_date'=>'nullable|date',
            'profession'=>'nullable|string',
            'image'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'id' => 'required|exists:members,id',
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
            'phone.required' => 'Téléphone est obligatoire',
            'phone.regex' => 'Téléphone est invalide',
            'phone.min' => 'Téléphone doit etre 10 caractères au minimum',
            'image.image' => 'Le logo normalement est une image',
            'image.mimes' => 'Extention non acceptable',
            'image.max' => 'La taille maximal est 2 MO',
            'id.required' => 'id membre est obligatoire',
            'id.exists' => 'membre non trouvé'
        ];
    }
}
