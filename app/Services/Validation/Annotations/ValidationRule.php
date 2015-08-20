<?php namespace ApiGfccm\Services\Validation\Annotations;

use Illuminate\Validation\Factory;
use ReflectionMethod;

/** @Annotation */
class ValidationRule
{
    public function mount(Factory $validator, ReflectionMethod $method)
    {
        $validator->extend($method->name, $method->class . '@' . $method->name);
    }
}
