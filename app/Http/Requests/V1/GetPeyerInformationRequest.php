<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class GetPeyerInformationRequest extends FormRequest
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


    protected function prepareForValidation()
    {

        $this->merge(['restaurantCode' => $this->route('restaurantCode')]);
        $this->merge(['OrderId' => $this->route('OrderId')]);

    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'restaurantCode' => 'required|numeric|exists:restraunts,code',
           'OrderId' => 'required|numeric|exists:orders,id',
        ];
    }
}
