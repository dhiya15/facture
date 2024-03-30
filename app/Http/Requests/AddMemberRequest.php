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
            'full_name_ar'=>'required|string',
            'full_name_fr'=>'required|string',
            'address_ar'=>'nullable|string',
            'address_fr'=>'nullable|string',
            'email'=>'nullable|string|email|unique:members',
            'phone'=>'nullable|string|unique:members|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
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
            'address_ar.required' => 'العنوان بالعربية اجباري',
            'address_fr.required' => 'العنوان بالفرنسية اجباري',
            'email.email' => 'ايميل غير صالح',
            'email.unique' => 'ايميل مستخدم من قبل',
            'phone.unique' => 'الهاتف مستخدم من قبل',
            'phone.regex' => 'الهاتف غير صالح',
            'phone.min' => 'يجب ان يكون رقم الهاتف من عشر ارقام على الاقل',
        ];
    }
}
