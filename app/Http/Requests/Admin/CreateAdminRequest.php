<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            'email' => 'email|required|unique:admins',
            'name' =>  'required',
            'phone' => 'required',
            'password' => 'required|min:6|max:15'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên là trường bắt buộc nhập',
            'email.required' => 'Email là trường bắt buộc nhập',
            'email.email' => 'Email chưa đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại là trường bắt buộc nhập',
            'password.required' => 'Mật khẩu là trường bắt buộc nhập',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không quá 15 ký tự',
        ];
    }
}
