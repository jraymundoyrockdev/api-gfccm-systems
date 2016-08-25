<?php

/**
 * Class TestCase
 */
class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    const UNKNOWN_ID = 0;
    const UNEXPECTED_KEYS = 'The array should only contain the specified keys found %s unexpected keys';

    /**
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    /**
     * @param $response
     */
    protected function assertResponseJson($response)
    {
        $headers = $response->headers;
        $this->assertEquals('application/json', $headers->get('content-type'));
    }

    /**
     * @param array $array
     * @param array $keys
     */
    protected function assertArrayHasKeys(array $array, array $keys)
    {
        array_walk($keys, function ($keys) use ($array) {
            $this->assertArrayHasKey($keys, $array);
        });
    }

    /**
     * @param array $array
     * @param array $keys
     */
    protected function assertArrayHasOnlyKeys(array $array, array $keys) {
        $keyLookup = array_flip($keys);
        $extraKeys = array_merge(
            array_diff_key($array, $keyLookup),
            array_diff_key($keyLookup, $array)
        );
        $this->assertEmpty(
            $extraKeys,
            sprintf(self::UNEXPECTED_KEYS, count($extraKeys))
        );
    }

    /**
     * @param array $attributes
     * @param $object
     */
    protected function assertObjectHasOnlyAttributes($attributes = [], $object)
    {
        foreach ($attributes as $attribute){
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }

    /**
     * @param array $keys
     * @param $expected
     * @param $actual
     */
    protected function attributeValuesEqualsToExpected($keys = [], $expected, $actual)
    {
        if (is_object($expected)) {
            $expected = json_decode(json_encode($expected), true);
        }

        if (is_object($actual)) {
            $actual = json_decode(json_encode($actual), true);
        }

        foreach ($keys as $key) {
            $this->assertEquals($expected[$key], $actual[$key]);
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function getFirstKey($data)
    {
        if(is_object($data)){
            $data = json_decode(json_encode($data), true);
        }

        return (is_null($data)) ? [] : $data[0];
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getLastKey($data = [])
    {
        return last($data);
    }
}
