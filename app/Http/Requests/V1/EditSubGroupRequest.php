<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class EditSubGroupRequest extends FormRequest
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
            'id' => 'required|numeric|exists:subgroups',
            'name' => 'required',
            'code' => 'required|numeric',
            //'code' => 'required|numeric|unique:subgroups,code',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'کد منحصربفرد الزامی میباشد',
            'id.exists' => 'کد منحصربفرد موجود نمیباشد',
            'id.numeric' => 'کد منحصربفرد شما الزاما باید عدد باشد',
            'name.required' => 'نام الزامی میباشد',
            'code.required' => 'کد الزامی میباشد',
            'code.numeric' => 'کد شما الزاما باید عدد باشد',
            'code.exists' => 'کد انتخابی شما موجود نمیباشد ',
            // 'code.unique' => 'کد انتخابی شما تکراری میباشد ',
        ];
    }
}
