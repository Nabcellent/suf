<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return isRed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request): array {
        return [
            'first_name'  => [
                'required',
                'max:20',
            ],
            'last_name'   => [
                'required',
                'max:20',
            ],
            'national_id' => ['bail', 'required', 'digits:8', 'unique:admins'],
            'email'       => 'required|email:rfc,dns|unique:users',
            'gender'      => 'required|alpha',
            'phone'       => [
                'required',
                'numeric',
                'digits_between:9,12',
                'unique:phones',
                'phone:KE'
            ],
        ];
    }
}
