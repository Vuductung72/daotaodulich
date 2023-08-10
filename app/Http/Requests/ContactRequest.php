<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên là trường bắt buộc nhập',
            'name.max' => 'Tên không dài quá 255 ký tự',
            'email.required' => 'Địa chỉ email là trường bắt buộc nhập',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'phone.required' => 'Số điện thoại là trường bắt buộc nhập',
            'phone.numeric' => 'Số điện thoại phải là dạng số',
            'phone.min' => 'Số điện thoại phải ít nhất 10 số',
        ];
    }
}
