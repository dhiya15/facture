<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpensesRequest extends FormRequest
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
            'id' => 'required|exists:jam3iya_expenses,id',
            'type'=>'required|exists:types,id',
            'amount'=>'required',
            'description'=>'nullable|string'
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
            'type.required' => 'Type est obligatoire',
            'amount.required' => 'Prix est obligatoire',
            'id.required' => 'id jem3iya est obligatoire',
            'id.exists' => 'Jem3iya non trouvé',
            'type.exists' => 'Type non trouvé'
        ];
    }
}
