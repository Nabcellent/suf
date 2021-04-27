<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return isAdmin() || isRed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'title' => 'required',
            'seller' => 'required|integer',
            'category' => 'sometimes|required',
            'sub_category' => 'required',
            'label' => 'required',
            'base_price' => 'required',
            'main_image' => 'sometimes|required|mimes:jpg,png,jpeg|max:5048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array {
        return [
            'title.required' => 'A title is required',
            'brand.required' => 'A brand is required',
            'main_image.mimes' => 'Only .jpg, .png, .jpeg are allowed for images'
        ];
    }
}
