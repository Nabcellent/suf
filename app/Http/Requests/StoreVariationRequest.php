<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreVariationRequest extends FormRequest
{
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
    public function rules(Request $request): array {
        return [
            'attribute' => [
                'required',
                Rule::unique('variations', 'attribute_id')->where(function ($query) use ($request) {
                    return $query->where('product_id', $request->input('product_id'));
                }),
            ],
            'options' => ['required', 'array'],
        ];
    }
}
