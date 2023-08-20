<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddYearRequest extends FormRequest
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
            'name'=>'required|string|unique:years',
            'month_amount'=>'required|numeric',
            'is_active'=>'nullable',
            'is_current'=>'nullable',
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
            'name.required' => 'Nom est obligatoire',
            'name.unique' => 'Nom est déja existe',
            'month_amount.required' => 'Prix est obligatoire',
        ];
    }
}
