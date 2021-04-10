<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:20|alpha',
            'last_name' => 'required|max:20|alpha',
            'email' => 'required|email:rfc,dns|unique:users',
            'gender' => 'required',
            'phone' => 'required|digits_between: 9, 10|unique:addresses',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages(): array {
        return [
            'phone.digits_between' => 'Your phone number must be between 9 and 10 numbers.'
        ];
    }
}
