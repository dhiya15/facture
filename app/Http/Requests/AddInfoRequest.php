<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddInfoRequest extends FormRequest
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
            'email'=>'nullable|string|email',
            'phone'=>'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address_ar'=>'nullable|string',
            'address_fr'=>'nullable|string',
            'register_number'=>'nullable|string',
            'id_number'=>'nullable|string',
            'statistics_number'=>'nullable|string',
            'account_number'=>'nullable|string',
            'agency_ar'=>'nullable|string',
            'agency_fr'=>'nullable|string',
            'key'=>'nullable|string',
            'key_ar'=>'nullable|string',
            'header_ar'=>'nullable|string',
            'header_fr'=>'nullable|string',
            'default'=>'nullable|boolean',
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
            'full_name.required' => 'الاسم اجباري',
            'email.email' => 'ايميل غير صالح',
            'phone.required' => 'العاتف اجباري',
            'phone.regex' => 'العاتف غير صالح',
            'phone.min' => 'يجب ان يكون رقم الهاتف من عشر ارقام على الاقل',
            'image.image' => 'يجب ان يكون الشعار عبارة عن صورة',
            'image.mimes' => 'امتداد غير مقبول',
            'image.max' => 'اكبر حجم مسموح هو 2 ميغا'
        ];
    }
}
