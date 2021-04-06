<?php

namespace App\Http\Requests\V1;

use App\Exceptions\V1\TestException;
use App\ToViewGenerator\ErrorExceptionValue;
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

    public function messages()
    {
        return [
            'phone.required' => ErrorExceptionValue::REQUIRED,
            'password.required' => ErrorExceptionValue::REQUIRED,

        ];
    }

    public function failedValidation(Validator $validator)
    {

        $errors = $validator->errors();
        $response = response()->json(['errors' => $errors],200);


        $array = [];
        foreach ($errors->toArray() as $keyErrorBag => $errorBag)
        {
            foreach ($errorBag as  $error)
            {
                array_push($array , ErrorExceptionValue::$fields[$keyErrorBag].$error);
            }
        }

        echo '<pre>';
        print_r($array);
        echo '<pre>';
        exit;

        //throw new HttpResponseException(response());
        //throw new TestException('This is Test Exception' , 200);
    }
}
