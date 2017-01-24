<?php

use ApiGfccm\Http\Controllers\Api\Transformers\IncomeServiceFundItemStructureTransformer;
use ApiGfccm\Models\IncomeServiceFundItemStructure;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServiceFundItemStructureTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;
    /** @test */
    public function it_transform_income_service_fund_items_structure_into_an_api_payload()
    {
        $incomeServiceFundItemStructure = factory(IncomeServiceFundItemStructure::class)->make();

        $expectedKeys = [
            'id',
            'fund_structure_id',
            'fund_item_id',
            'name'
        ];

        $result = new IncomeServiceFundItemStructureTransformer();
        $result = $result->transform($incomeServiceFundItemStructure);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected($expectedKeys, $incomeServiceFundItemStructure, $result);
    }
}