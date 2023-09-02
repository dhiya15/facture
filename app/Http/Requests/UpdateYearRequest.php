<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateYearRequest extends FormRequest
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
            'id' => 'required|exists:years,id',
            'name'=>'required|string',
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
            'name.required' => 'الاسم اجباري',
            'name.exists' => 'اسم موجود من قبل',
            'month_amount.required' => 'المبلغ السنوي اجباري',
            'id.required' => 'معرف السنة اجباري',
            'id.exists' => 'سنة مالية غير موجودة'
        ];
    }
}
