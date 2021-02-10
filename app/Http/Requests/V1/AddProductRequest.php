<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name'      =>  'required|',
            'type'      =>  'required|exists:types,id|numeric',
            'maingroup' =>  'required|exists:maingroups,id|numeric',
            'subgroup'  =>  'required|exists:subgroups,id|numeric',
            'code'      =>  'required|numeric',
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'نام الزامی میباشد',
            'code.required' => 'کد الزامی میباشد',
            'code.numeric'  => 'کد شما الزاما باید عدد باشد',
            'code.unique'   => 'کد انتخابی شما تکراری است',
            'type.exists'   => 'دسته شما موجود نمیباشد',
            'maingroup.exists'   => 'گروه اصلی شما موجود نمیباشد',
            'subgroup.exists'   => 'گروه فرعی شما موجود نمیباشد',
        ];
    }
}
