<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    const UNEXPECTED_KEYS = 'The array should only contain the specified keys found %s unexpected keys';

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

    protected function assertResponseJson($response)
    {
        $headers = $response->headers;
        $this->assertEquals('application/json', $headers->get('content-type'));
    }

    protected function assertArrayHasKeys(array $array, array $keys)
    {
        array_walk($keys, function ($keys) use ($array) {
            $this->assertArrayHasKey($keys, $array);
        });
    }

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
}
