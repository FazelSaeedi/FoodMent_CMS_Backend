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
            'user' => 'required',
            'code' => 'required|numeric|unique:restraunts',
            'address' => 'required',
          // banner => '',
          // image1 => '',
          // image2 => '',
          // image3 => '',

        ];
    }
}
