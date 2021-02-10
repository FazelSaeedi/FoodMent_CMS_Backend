<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class AddRestrauntRequest extends FormRequest
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

            'name' => 'required',
            'adminid' => 'required|exists:users,id',
            'code' => 'required|numeric|unique:restraunts',
            'address' => 'required',
            'phone' => 'required|numeric',
          // banner => '',
            'photo1' => 'required|mimes:jpeg,png,jpg',
            'photo2' => 'required|mimes:jpeg,png,jpg',
            'photo3' => 'required|mimes:jpeg,png,jpg',

        ];
    }
}
