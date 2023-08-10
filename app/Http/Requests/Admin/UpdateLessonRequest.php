<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Lesson;
class UpdateLessonRequest extends FormRequest
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
            // 'order' => Lesson::find($this->input('id'))->order == $this->input('order') ? '' : 'required|min:1|unique:lessons',
            'order' => 'required|min:1',
            'thumb' => 'mimes:jpeg,png,jpg,gif,svg|max:5120',
            'content' => 'required',
        ];
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên bài học là trường bắt buộc nhập',
            'name.max' => 'Tên bài học không dài quá 255 ký tự',
            'order.required' => 'Vị trí là trường bắt buộc nhập',
            'order.min' => 'Vị trí phải có giá trị lớn hơn 0',
            'thumb.mimes' => 'Ảnh đại diện không đúng định dạng jpeg,png,jpg,gif,svg',
            'thumb.max' => 'Ảnh đại diện kích thước không được vượt quá 5120 Mb',
            'content.required' => 'Nội dung là trường bắt buộc nhập',
        ];
    }
}
