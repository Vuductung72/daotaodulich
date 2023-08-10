<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'image' =>  'mimes:jpeg,png,jpg,gif,svg|max:5120',
            'description' => 'max:255'
        ];
    }
    
    public function messages()
    {
        return [
            'description.max' => 'Mô tả ngắn không vượt quá 255 ký tự'
        ];
    }
}
