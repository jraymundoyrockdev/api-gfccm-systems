<?php

use ApiGfccm\Models\Denomination;
use ApiGfccm\Models\IncomeService;

class IncomeServiceDenominationTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_an_income_service()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeServiceDenomination[belongsTo]');
        $model->shouldReceive('belongsTo')->with(IncomeService::class)->andReturn(true);

        $this->assertTrue($model->income_service());
    }

    /**
     * @test
     */
    public function it_belongs_to_a_denomination()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeServiceDenomination[belongsTo]');
        $model->shouldReceive('belongsTo')->with(Denomination::class)->andReturn(true);

        $this->assertTrue($model->denomination());
    }
}
