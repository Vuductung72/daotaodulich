<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreatePartnersRequest extends FormRequest
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
            'image' =>  'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'email' => 'email|required|unique:partners',
            'phone' => 'required',
            'address' => 'required',
            'description' => 'required',
        ];
    }
}
