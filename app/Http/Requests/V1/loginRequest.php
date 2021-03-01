<?php

namespace App\Http\Requests\V1;

use App\Exceptions\V1\TestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class loginRequest extends FormRequest
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
            'phone' => 'required',
            'password' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        //$errors = $validator->errors();

        //throw new HttpResponseException(response()->json(['errors' => $errors],200));
        //throw new TestException('This is Test Exception' , 200);
    }
}
