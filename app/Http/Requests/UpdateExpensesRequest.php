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
            'type.required' => 'النوع احباري',
            'amount.required' => 'المبلغ اجباري',
            'id.required' => 'معرف الجمعية اجباري',
            'id.exists' => 'جمعية غير موجودة',
            'type.exists' => 'نوع غير موجود'
        ];
    }
}
