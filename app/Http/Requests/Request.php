<?php

namespace ApiGfccm\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{

    /**
     * {@inheritdoc}
     */
    protected function formatErrors(Validator $validator)
    {
        return [
            'message' => 'Validation Error',
            'errors' => $validator->errors()
        ];
    }
}
