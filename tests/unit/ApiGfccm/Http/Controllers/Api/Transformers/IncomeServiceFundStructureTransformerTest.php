<?php

use ApiGfccm\Http\Controllers\Api\Transformers\IncomeServiceFundStructureTransformer;
use ApiGfccm\Models\IncomeServiceFundItemStructure;
use ApiGfccm\Models\IncomeServiceFundStructure;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServiceFundStructureTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_transforms_income_service_fund_structure_into_an_api_payload()
    {
        $incomeServiceFundStructure = factory(IncomeServiceFundStructure::class)->make();
        factory(IncomeServiceFundItemStructure::class)->create([
            'fund_structure_id' => $incomeServiceFundStructure->id
        ]);

        $expectedKeys = [
            'id',
            'income_service_id',
            'fund_id',
            'name',
            'item'
        ];

        $transformer = new IncomeServiceFundStructureTransformer();
        $result = $transformer->transform($incomeServiceFundStructure);


        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
    }
}