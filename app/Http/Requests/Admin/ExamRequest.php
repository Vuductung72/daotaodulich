<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'name' => 'required',
            'number' => 'required|numeric',
            'number_pass' => 'required|numeric',
            'time' => 'required|numeric',
            'money' => 'required|numeric',
            'profession_id' => 'required',
            'course_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên bộ đề là trường bắt buộc nhập',
            'number.required' => 'Số câu là trường bắt buộc nhập',
            'number.numeric' => 'Số câu phải là dạng số',
            'number_pass.required' => 'Số câu bắt buộc đúng là trường bắt buộc nhập',
            'number_pass.numeric' => 'Số câu bắt buộc đúng phải là dạng số',
            'time.required' => 'Thời gian là trường bắt buộc nhập',
            'time.numeric' => 'Thời gian phải là dạng số',
            'money.required' => 'Lệ phí là trường bắt buộc nhập',
            'money.numeric' => 'Lệ phí phải là dạng số',
            'profession_id.required' => 'Ngành nghề là trường bắt buộc chọn',
            'course_id.required' => 'Khoá học là trường bắt buộc chọn',

        ];
    }
}
