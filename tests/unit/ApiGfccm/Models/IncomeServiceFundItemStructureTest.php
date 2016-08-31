<?php

use ApiGfccm\Models\IncomeServiceFundStructure;

class IncomeServiceFundItemStructureTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_an_income_service_fund_item_structure()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeServiceFundItemStructure[belongsTo]');
        $model->shouldReceive('belongsTo')->with(IncomeServiceFundStructure::class)->andReturn(true);

        $this->assertTrue($model->fund_structure());
    }
}
