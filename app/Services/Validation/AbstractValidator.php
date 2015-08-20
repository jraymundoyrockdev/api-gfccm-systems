<?php namespace ApiGfccm\Services\Validation;

use Doctrine\Common\Annotations\AnnotationReader;
use Illuminate\Validation\Factory;
use ApiGfccm\Services\Validation\Annotations\ValidationCondition;
use ApiGfccm\Services\Validation\Annotations\ValidationRule;
use ReflectionObject;

abstract class AbstractValidator
{
    /**
     * @var Array
     */
    protected static $data = array();

    /**
     * Array of custom validation messages
     *
     * @var Array
     */
    protected $messages = array();

    /**
     * @var Array
     */
    protected $errors = array();

    /**
     * @var Array
     */
    protected $rules = array();

    /**
     * @var Factory
     */
    protected $validator;

    /**
     * @var AnnotationReader
     */
    protected $annotationReader;

    public function __construct(Factory $validator, AnnotationReader $annotationReader)
    {
        $this->validator = $validator;
        $this->annotationReader = $annotationReader;
    }

    public function with(array $data)
    {
        self::$data = $data;
        return $this;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function passes()
    {
        $this->registerCustomRules();
        $validator = $this->validator->make(self::$data, $this->rules, $this->messages);
        $this->attachValidationConditions($validator);
        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }

    private function registerCustomRules()
    {
        $reflectionObject = new ReflectionObject($this);
        foreach ($reflectionObject->getMethods() as $method) {
            $this->processRuleAnnotation($method);
        }
    }

    private function attachValidationConditions($validator)
    {
        $reflectionObject = new ReflectionObject($this);
        foreach ($reflectionObject->getMethods() as $method) {
            $this->processConditionAnnotations($validator, $method);
        }
    }

    /**
     * @param $method
     */
    private function processRuleAnnotation($method)
    {
        $annotation = $this->annotationReader->getMethodAnnotation(
            $method,
            'ApiGfccm\Services\Validation\Annotations\ValidationRule'
        );
        if ($annotation instanceof ValidationRule) {
            $annotation->mount($this->validator, $method);
        }
    }

    /**
     * @param $validator
     * @param $method
     */
    private function processConditionAnnotations($validator, $method)
    {
        $annotations = $this->annotationReader->getMethodAnnotations($method);
        foreach ($annotations as $annotation) {
            $this->attachCondition($validator, $method, $annotation);
        }
    }

    /**
     * @param $validator
     * @param $method
     * @param $annotation
     */
    private function attachCondition($validator, $method, $annotation)
    {
        if ($annotation instanceof ValidationCondition) {
            $annotation->validationCondition($this, $validator, $method);
        }
    }
}
