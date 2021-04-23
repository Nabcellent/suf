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
            'phone' => 'bail|required|numeric|digits:10|unique:phones',
            'national_id' => 'bail|required|integer|unique:admins',
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
