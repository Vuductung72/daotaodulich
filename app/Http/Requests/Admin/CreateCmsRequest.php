<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCmsRequest extends FormRequest
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
            'name' => 'required|string|min:8|max:255',
            'content' => 'required|min:8',
            'description' => 'required|min:8',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
    }
}
