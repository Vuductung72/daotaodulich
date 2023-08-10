<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeedbackRequest extends FormRequest
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
            'avatar' =>  'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'position' => 'required',
            'position_type' => 'required',
            'content' => 'required',
        ];
    }
}
