<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class AddMainGroupRequest extends FormRequest
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
            'code' => 'required|numeric|unique:maingroups',
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'نام الزامی میباشد',
            'code.required' => 'کد الزامی میباشد',
            'code.numeric' => 'کد شما الزاما باید عدد باشد',
            'code.unique' => 'کد انتخابی شما تکراری است',
        ];
    }

}
