<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'email|unique:users',
            'name' =>  'required|max:255',
            'phone' => 'required|numeric',
            'address' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email không đúng định dạng',
            'name.required' => 'Họ và tên là trường thông tin bắt buộc nhập',
            'name.max' => 'Họ và tên không được dài quá 255 ký tự',
            'phone.required' => 'Số điện thoại là trường thông tin bắt buộc nhập',
            'phone.numeric' => 'Số điện thoại phải là dạng số',
            'address.max' => 'Địa chỉ không được dài quá 255 ký tự',
        ];
    }
}
