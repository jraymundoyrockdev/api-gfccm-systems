<?php

use ApiGfccm\Http\Controllers\Api\Transformers\FundTransformer;
use ApiGfccm\Models\Fund;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

/**
 * Class FundTransformerTest
 */
class FundTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_transforms_a_fund_into_an_api_payload()
    {
        $fund = factory(Fund::class)->make();

        $expectedKeys = ['id', 'name', 'description', 'category', 'status'];


        $result = (new FundTransformer())->transform($fund);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected($expectedKeys, $fund, $result);
    }

}