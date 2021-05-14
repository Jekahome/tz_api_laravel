<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginClientRequest extends FormRequest
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
            'phone' => 'required|regex:/(380)[0-9]{9}/'
        ];
    }

    public function messages()
    {
        return [
            'phone' => 'Phone number is not correct.'
        ];
    }
}
