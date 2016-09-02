<?php

use ApiGfccm\Models\IncomeServiceFundItemStructure;

class IncomeServiceFundStructureTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_has_many_income_service_fund_item_structure()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeServiceFundStructure[hasMany]');
        $model->shouldReceive('hasMany')
            ->with(IncomeServiceFundItemStructure::class, 'fund_structure_id', 'id')
            ->andReturn(true);

        $this->assertTrue($model->item_structures());
    }
}
