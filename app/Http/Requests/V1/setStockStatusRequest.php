<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class setStockStatusRequest extends FormRequest
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
        $this->merge(['id' => $this->route('id')]);
        $this->merge(['status' => $this->route('status')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:menu,id',
            'restaurantCode' => 'required|numeric|exists:restraunts,code',
            'status' => 'required|numeric|boolean',
        ];
    }
}
