<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MpesaSTKPushSimulateRequest extends FormRequest
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
            'amount' => ['required', 'numeric'],
            'sender_phone' => ['required', 'numeric', 'max:12'],
            'payer_phone' => ['required', 'numeric', 'max:12'],
            'account_reference' => ['required', 'max:20'],
        ];
    }
}
