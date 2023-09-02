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
            'full_name.required' => 'الاسم اجباري',
            'email.email' => 'ايميل غير صالح',
            'phone.required' => 'الهاتف اجباري',
            'phone.regex' => 'الهاتف غير صالح',
            'phone.min' => 'يجب ان يكون رقم الهاتف من عشر ارقام على الاقل',
            'image.image' => 'يجب ان يكون الشعار عبارة عن صورة',
            'image.mimes' => 'امتداد غير مقبول',
            'image.max' => 'اكبر حجم مسموح هو 2 ميغا',
            'id.required' => 'معرف العضو اجباري',
            'id.exists' => 'عضو غير موجود'
        ];
    }
}
