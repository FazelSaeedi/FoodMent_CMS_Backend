<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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

    public function rules()
    {
        return [
            'id' => 'required|exists:products',
            'name' => 'required',
            'type' => 'required|exists:types,id',
            'maingroup' => 'required|exists:maingroups,id',
            'subgroup'  => 'required|exists:subgroups,id',
            'code' =>  'required|numeric',
        ];
    }
}
