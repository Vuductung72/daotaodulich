<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'email|required|unique:users',
            'name' =>  'required|max:255',
            'phone' => 'required|min:10',
            'password' => 'required|min:6|max:15',
            're-password' => 'required|same:password',
            'agree-term' => 'accepted',
        ];

    }

    public function messages()
    {
        return [
            'email.email' => 'Email không đúng định dạng',
            'email.required' => 'Email là trường bắt buộc nhập',
            'email.unique' => 'Email đã bị trùng',
            'name.required' => 'Tên là trường bắt buộc nhập',
            'name.max' => 'Tên không được dài quá 255 ký tự',
            'phone.required' => 'Số điện thoại là trường bắt buộc nhập',
            'phone.min' => 'Số điện thoại tối thiểu 10 số',
            'password.required' => 'Mật khẩu là trường bắt buộc nhập',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 15 ký tự',
            're-password.same' => 'Nhập lại mật khẩu không khớp',
            're-password.required' => 'Nhập lại mật khẩu là trường bắt buộc nhập',
            'accepted' => 'Bạn chưa đồng ý với các điều khoản dịch vụ'
        ];
    }
}
