<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'fullname' =>  'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|max:15',
            're-password' => 'required|same:password',
            'type' =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Tên là trường bắt buộc nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.required' => 'Email là trường bắt buộc nhập',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu là trường bắt buộc nhập',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 15 ký tự',
            're-password.required' => 'Nhập lại mật khẩu là trường bắt buộc nhập',
            're-password.same' => 'Nhập lại mật khẩu không khớp',
            'type.required' => 'Tên chuyên gia là trường bắt buộc chọn',
        ];
    }
}
