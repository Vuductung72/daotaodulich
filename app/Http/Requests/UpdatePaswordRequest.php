<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaswordRequest extends FormRequest
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
            'password' => 'required|min:6|max:15',
            're-password' => 'required|same:password',
        ];

    }

    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu là trường bắt buộc nhập',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 15 ký tự',
            're-password.same' => 'Nhập lại mật khẩu không khớp',
            're-password.required' => 'Nhập lại mật khẩu là trường bắt buộc nhập',
        ];
    }
}
