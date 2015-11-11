<?php

namespace ApiGfccm\Http\Requests;

use ApiGfccm\Http\Requests\Request;

class IncomeServiceMemberFundRequest extends Request
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
            'income_service_id' => 'required|integer',
            'member_id' => 'required|integer'
        ];
    }

    /**
     * Override existing rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'income_service_id.required' => 'Income Service field is required.',
            'member_id.required' => 'Member field is required.'
        ];
    }
}
