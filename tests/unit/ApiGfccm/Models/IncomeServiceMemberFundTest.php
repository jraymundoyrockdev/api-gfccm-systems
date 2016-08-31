<?php

use ApiGfccm\Models\IncomeService;

class IncomeServiceMemberFundTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_an_income_service_member_fund()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeServiceMemberFund[belongsTo]');
        $model->shouldReceive('belongsTo')->with(IncomeService::class)->andReturn(true);

        $this->assertTrue($model->income_service());
    }
}
