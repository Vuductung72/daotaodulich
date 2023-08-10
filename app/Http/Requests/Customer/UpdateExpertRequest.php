<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpertRequest extends FormRequest
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
            'phone' =>  'required|min:10|numeric',
            'nationality' =>  'required',
            'regular_address' =>  'required',
            'current_address' =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Họ và tên là trường bắt buộc nhập',
            'phone.required' => 'Số điện thoại là trường bắt buộc nhập',
            'phone.min' => 'Số điện thoại phải chứa ít nhất 10 số',
            'phone.numeric' => 'Số điện thoại phải là số',
            'nationality.required' => 'Quốc tịch là trường bắt buộc nhập',
            'regular_address.required' => 'Địa chỉ thường trú là trường bắt buộc nhập',
            'current_address.required' => 'Địa chỉ hiện tại là trường bắt buộc nhập',
        ];
    }
}
