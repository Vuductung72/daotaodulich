<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên bài viết là trường bắt buộc nhập',
            'name.max' => 'Tên bài viết không dài quá 255 ký tự',
            'image.required' => 'Hình ảnh là trường bắt buộc nhập',
            'image.mimes' => 'Hình ảnh không đúng định dạng jpeg,png,jpg,gif,svg',
            'image.max' => 'Hình ảnh kích thước không được vượt quá 5120 Mb',
        ];
    }
}
