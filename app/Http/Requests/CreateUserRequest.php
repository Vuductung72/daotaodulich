<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' =>  'required',
            'password' => 'required|min:6|max:15',
            'code' =>  'required',
        ];
    }

    public function messeage()
    {
        return [
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã bị trùng',
            'email.required' => 'Email là trường bắt buộc',
            'name.unique' => 'Tên người dùng đã bị trùng',
            'name.required' => 'Tên là trường bắt buộc',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 15 ký tự',
            'code.unique' => 'Mã đại lý đã bị trùng',
        ];
    }
}
