<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductRequest extends FormRequest
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
            'id' =>  'required|numeric',
        ];
    }


    public function messages()
    {
        return [
            'id.required' => 'کد الزامی میباشد',
            'id.numeric' => 'کد شما الزاما باید عدد باشد',
        ];
    }
}
