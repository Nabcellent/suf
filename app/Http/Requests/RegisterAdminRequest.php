<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'first_name' => 'bail|required|max:20|alpha',
            'last_name' => 'bail|required|max:20|alpha',
            'username' => 'bail|required|max:30|unique:admins',
            'email' => 'bail|required|email:rfc,dns|unique:users',
            'gender' => 'bail|required|alpha',
            'phone' => ['required',
                'numeric',
                'digits_between:9,12',
                'unique:phones',
                'regex:/^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6}))$/i'
            ],
            'password' => 'bail|required|confirmed',
            'password_confirmation' => 'bail|required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array {
        return [
            //
        ];
    }
}
