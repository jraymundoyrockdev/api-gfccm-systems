<?php

namespace ApiGfccm\Http\Requests;

use ApiGfccm\Http\Requests\Request;

class MemberRequest extends Request
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
            'firstname' => 'required|alpha'/*,
            'lastname' => 'required|alpha',
            'apellation' => 'required|alpha',
            'gender' => 'required|alpha',
            'birthdate' => 'required',
            'address' => 'required',
            'phone_mobile' => 'max:15',
            'email' => 'email'*/
        ];
    }
}
