<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmSmsCode extends FormRequest
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
            'phonenumber' => 'required|numeric',
            'smscode' => 'required|numeric'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (strlen($this->phonenumber) != 11) {
                $validator->errors()->add('phonenumber', 'must be 10 character');
            }

            if (strlen($this->smscode) != 4) {
                $validator->errors()->add('smscode', 'must be 4 character');
            }
        });
    }

}
