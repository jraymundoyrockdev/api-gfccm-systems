<?php

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\Member;

class IncomeServiceMemberFundTotalTest extends TestCase
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
        $model = Mockery::mock('ApiGfccm\Models\IncomeServiceMemberFundTotal[belongsTo]');
        $model->shouldReceive('belongsTo')->with(IncomeService::class)->andReturn(true);

        $this->assertTrue($model->income_service());
    }

    /**
     * @test
     */
    public function it_belongs_to_a_member()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeServiceMemberFundTotal[belongsTo]');
        $model->shouldReceive('belongsTo')->with(Member::class)->andReturn(true);

        $this->assertTrue($model->member());
    }

}
