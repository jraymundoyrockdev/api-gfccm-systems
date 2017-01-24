<?php

use ApiGfccm\Http\Controllers\Api\Transformers\IncomeServiceDenominationTransformer;
use ApiGfccm\Models\IncomeServiceDenomination;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServiceDenominationTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;
    /** @test */
    public function it_transform_income_service_denomination_into_an_api_payload()
    {
        $incomeServiceDenomination = factory(IncomeServiceDenomination::class)->make();

        $expectedKeys = [
            'id',
            'income_service_id',
            'denomination_id',
            'description',
            'amount',
            'piece',
            'total'
        ];

        $result = new IncomeServiceDenominationTransformer;
        $result = $result->transform($incomeServiceDenomination);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected($expectedKeys, $incomeServiceDenomination, $result);
    }
}