<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreVariationOptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAdmin() || isRed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'variant' => [
                'required',
                'alpha',
                Rule::unique('variations_options')->where(function ($query) use ($request) {
                    return $query->where('variation_id', $request->variation_id);
                }),
            ],
            'stock' => ['required', 'integer'],
            'extra_price' => ['required', 'numeric']
        ];
    }
}
