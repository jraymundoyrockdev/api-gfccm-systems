<?php

namespace ApiGfccm\Http\Requests;

class MinistryTransactionRequest extends Request
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
            'ministry_id' => 'required|integer',
            'type' => 'required',
            'amount' => 'required|numeric',
            'transaction_date' => 'required|date_format:Y-m-d',
            'description' => 'required'
        ];
    }
}
