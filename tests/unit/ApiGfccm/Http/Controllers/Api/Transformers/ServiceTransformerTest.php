<?php

use ApiGfccm\Http\Controllers\Api\Transformers\ServiceTransformer;
use ApiGfccm\Models\Service;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

/**
 * Class ServiceTransformerTest
 */
class ServiceTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_transforms_a_service_into_an_api_payload()
    {
        $service = factory(Service::class)->make();

        $expectedKeys = ['id', 'name', 'start_time', 'end_time', 'description'];

        $result = (new ServiceTransformer())->transform($service);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected(['id', 'name', 'description'], $service, $result);
        $this->assertEquals($this->reformatTime($service->start_time), $result['start_time']);
        $this->assertEquals($this->reformatTime($service->end_time), $result['end_time']);
    }

    /**
     * Reformat Time
     *
     * @param $time
     * @param string $format
     * @return bool|string
     */
    private function reformatTime($time, $format = 'H:i')
    {
        return date($format, strtotime($time));
    }

}