<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateProfessionRequest extends FormRequest
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
            'profession_code' => 'required|max:50|unique:professions',
            'name' => 'required|max:50',
        ];
    }
    public function messages()
    {
        return [
            'profession_code.required' => 'Mã ngành chưa được nhập',
            'profession_code.max' => 'Mã ngành không được vượt quá 50 ký tự',
            'profession_code.unique' => 'Mã ngành đã tồn tại',
            'name.required' => 'Tên ngành chưa được nhập',
            'name.max' => 'Tên ngành không được vượt quá 255 ký tự',
        ];
    }
}
