<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return Auth::user()->type !== 'Seller';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'category_title' => 'bail|sometimes|present|required|string',
            'sub_category_title' => 'bail|sometimes|present|required|string',
            'discount' => 'integer|max:99',
            'section' => 'bail|sometimes|required|integer|exists:App\Models\Category,id',
            'sections' => 'bail|sometimes|required|array|exists:App\Models\Category,id',
            'category' => 'bail|sometimes|required|integer|exists:App\Models\Category,id',
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
