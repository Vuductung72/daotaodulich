<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInternshipRequest extends FormRequest
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
        // dd($this->request->all()['password']);
        return [
            'fullname' =>  'required',
            'password' => ($this->request->all()['password'] != null) ?  'min:6' : '',
            'regular_address' =>  'required|max:255',
            'phone' =>  'required|numeric',
            'description' =>  'required|max:700'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Tên công ty là trường bắt buộc nhập',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'regular_address.required' => 'Địa chỉ là trường bắt buộc nhập',
            'regular_address.max' => 'Địa chỉ không vượt quá 255 ký tự',
            'phone.required' => 'Số điện thoại là trường bắt buộc nhập',
            'phone.numeric' => 'Số điện thoại phải là dạng số',
            'description.required' => 'Mô tả ngắn là trường bắt buộc nhập',
            'description.max' => 'Mô tả ngắn không vượt quá 700 ký tự',
        ];
    }
}
