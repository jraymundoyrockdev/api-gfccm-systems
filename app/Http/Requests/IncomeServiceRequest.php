<?php namespace ApiGfccm\Http\Requests;

class IncomeServiceRequest extends Request
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
            'service_id' => 'required|integer',
            'service_date' => 'required|date_format:Y-m-d',
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
            'service_id.required' => 'Service field is required.',
            'service_date.required' => 'Service date is required.'
        ];
    }
}
