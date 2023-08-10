<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateInternshipRequest extends FormRequest
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
            'title' => 'required|max:255',
            'describe' => 'required|max:255',
            'quantity' => 'required|numeric',
            'wage' => 'required|numeric',
            'time' =>  'required',
            'start_time' =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc chọn',
            'title.max' => 'Tiêu đề không vượt quá 255 ký tự',
            'describe.required' => 'Mô tả là trường bắt buộc chọn',
            'describe.max' => 'Mô tả không vượt quá 255 ký tự',
            'quantity.required' => 'Số lượng là trường bắt buộc chọn',
            'quantity.numeric' => 'Số lượng phải là dạng số',
            'wage.required' => 'Số lương là trường bắt buộc chọn',
            'wage.numeric' => 'Số lương phải là dạng số',
            'time.required' => 'Thời gian thực tập là trường bắt buộc chọn',
            'start_time.required' => 'Thời gian bắt đầu thực tập là trường bắt buộc chọn',
        ];
    }
}
