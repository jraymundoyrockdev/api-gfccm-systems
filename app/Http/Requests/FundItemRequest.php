<?php

namespace ApiGfccm\Http\Requests;

class FundItemRequest extends Request
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
            'fund_id' => 'required',
            'name' => 'required'
        ];
    }
}
