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
            'full_name_ar'=>'required|string',
            'full_name_fr'=>'required|string',
            'address_ar'=>'nullable|string',
            'address_fr'=>'nullable|string',
            'email'=>'nullable|string',
            'phone'=>'nullable|string',
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
            'full_name_ar.required' => 'الاسم بالعربية اجباري',
            'full_name_fr.required' => 'الاسم بالفرنسية اجباري',
            'id.required' => 'معرف العضو اجباري',
            'id.exists' => 'عضو غير موجود'
        ];
    }
}
