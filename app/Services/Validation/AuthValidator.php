<?php namespace ApiGfccm\Services\Validation;

class AuthValidator extends AbstractValidator
{
    /**
     * Validation rules for the login form
     *
     * @var array
     */
    protected $rules = [
        'username' => 'sometimes|required',
        'password' => 'sometimes|required',
    ];

    protected $messages = [
        'username.required' => "Please enter your Username.",
        'password.required' => "Please enter your password."
    ];
}
