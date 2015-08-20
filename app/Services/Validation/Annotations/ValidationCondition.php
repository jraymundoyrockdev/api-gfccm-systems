<?php namespace ApiGfccm\Services\Validation\Annotations;

use Illuminate\Validation\Validator;
use ApiGfccm\Services\Validation\AbstractValidator;
use ReflectionMethod;

/**
 * Conditionally apply a validation rule
 *
 * @Annotation
 */
class ValidationCondition
{
    public $attribute;

    public $rules;

    public function validationCondition(
        AbstractValidator $validator,
        Validator $validatorInstance,
        ReflectionMethod $method
    ) {
        $condition = $method->getClosure($validator);
        $validatorInstance->sometimes($this->attribute, $this->rules, $condiation);
    }
}
