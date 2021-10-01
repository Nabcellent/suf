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
            'first_name' => ['bail', 'required', 'max:20', "regex:/^[a-zA-Z]+(?:(?:\.|[' ])([a-zA-Z])*)*$/i"],
            'last_name' => ['bail', 'required', 'max:20', "regex:/^[a-zA-Z]+(?:(?:\.|[' ])([a-zA-Z])*)*$/i"],
            'username' => 'bail|required|max:30|unique:admins',
            'email' => 'bail|required|email:rfc,dns|unique:users',
            'gender' => 'bail|required|alpha',
            'phone' => ['required', 'unique:phones', 'phone:KE'],
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
