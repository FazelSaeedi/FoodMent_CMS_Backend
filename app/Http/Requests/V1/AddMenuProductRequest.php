<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class AddMenuProductRequest extends FormRequest
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
            'productid' => 'required|exists:products,id',
            'restrauntid' => 'required|exists:restraunts,id',
            'price' => 'required|numeric',
            'discount' => 'required|numeric|max:99',
            'makeups' => 'required',
            'photo1' => 'required|mimes:jpeg,png,jpg',
            'photo2' => 'required|mimes:jpeg,png,jpg',
            'photo3' => 'required|mimes:jpeg,png,jpg',
        ];
    }
}
