<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isRed() || isSuper();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request) {
        $rules = [
            'title' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'link' => 'url',
            'alt' => 'required_with:image'
        ];

        if($request->isMethod('POST')) {
            $rules['image'] = 'required|mimes:jpg,png,jpeg|max:5048';
        }

        return $rules;
    }
}
