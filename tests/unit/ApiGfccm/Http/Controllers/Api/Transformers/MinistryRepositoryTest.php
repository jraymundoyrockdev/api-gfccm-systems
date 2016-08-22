<?php

use ApiGfccm\Http\Controllers\Api\Transformers\MinistryTransformer;
use ApiGfccm\Models\Ministry;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

/**
 * Class FundTransformerTest
 */
class MinistryTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_transforms_a_ministry_into_an_api_payload()
    {
        $role = factory(Ministry::class)->make();

        $expectedKeys = ['id', 'name', 'description'];

        $result = (new MinistryTransformer)->transform($role);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected($expectedKeys, $role, $result);
    }

}