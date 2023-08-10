<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required',
            'description' => 'required|max:255',
            'keyword' => 'max:255',
            'thumb' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên khóa học là trường bắt buộc nhập',
            'name.max' => 'Tên khóa học không dài quá 255 ký tự',
            'price' => 'Giá khóa học là trường bắt buộc nhập',
            'description.required' => 'Mô tả ngắn là trường bắt buộc nhập',
            'description.max' => 'Mô tả ngắn không dài quá 255 ký tự',
            'keyword.max' => 'Keywords không dài quá 255 ký tự',
            'thumb.required' => 'Ảnh đại diện là trường bắt buộc nhập',
            'thumb.mimes' => 'Ảnh đại diện không đúng định dạng jpeg,png,jpg,gif,svg',
            'thumb.max' => 'Ảnh đại diện kích thước không được vượt quá 5120 Mb',
        ];
    }
}
