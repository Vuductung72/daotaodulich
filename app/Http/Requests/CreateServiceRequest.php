<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
            'qrcode_id' => 'required|not_in:0',
            'date_buy' => 'required|date',
            'date_expired' => 'required|date|after:date_buy',
            'image' => 'nullable',
        ];


    }

}
