<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreatePartnerPopupRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'image' =>  'sometimes|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'video' =>  'sometimes|mimes:mp4,mov,ogg,qt|max:5120',
            'type'  =>  'required',
            'partner_id' => 'required'
        ];
    }
}
