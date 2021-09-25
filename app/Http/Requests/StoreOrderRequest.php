<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'address' => 'bail|present|required|integer|exists:addresses,id',
            'phone' => ['required',
                'numeric',
                'digits_between:9,12',
                'regex:/^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\+254|0)?(77[0-6][0-9]{6})$)$/i'
            ],
            'payment_method' => 'present|required|alpha_dash',
        ];
    }

    public function messages(): array {
        return [
            'address.required' => 'Please choose a delivery address or add one if you can\'t see the one you\'re looking for',
            'phone.required' => 'Please Select a phone number so we can keep in touch during the order process',
            'phone.regex' => 'The phone number is invalid.',
            'payment_method.required' => 'Please Select a payment method.'
        ];
    }
}
