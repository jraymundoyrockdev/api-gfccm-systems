<?php

use ApiGfccm\Models\IncomeServiceDenomination;
use ApiGfccm\Models\IncomeServiceFundStructure;
use ApiGfccm\Models\IncomeServiceMemberFundTotal;
use ApiGfccm\Models\Service;
use ApiGfccm\Models\User;

class IncomeServiceTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_a_service()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeService[belongsTo]');
        $model->shouldReceive('belongsTo')->with(Service::class)->andReturn(true);

        $this->assertTrue($model->service());
    }

    /**
     * @test
     */
    public function it_has_one_user()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeService[hasOne]');
        $model->shouldReceive('hasOne')->with(User::class, 'id', 'created_by')->andReturn(true);

        $this->assertTrue($model->user());
    }

    /**
     * @test
     */
    public function it_has_many_fund_structures()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeService[hasMany]');
        $model->shouldReceive('hasMany')->with(IncomeServiceFundStructure::class)->andReturn(true);

        $this->assertTrue($model->fund_structures());
    }

    /**
     * @test
     */
    public function it_has_many_denomination_structures()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeService[hasMany]');
        $model->shouldReceive('hasMany')->with(IncomeServiceDenomination::class)->andReturn(true);

        $this->assertTrue($model->denomination_structures());
    }

    /**
     * @test
     */
    public function it_has_many_member_fund_totals()
    {
        $model = Mockery::mock('ApiGfccm\Models\IncomeService[hasMany]');
        $model->shouldReceive('hasMany')->with(IncomeServiceMemberFundTotal::class)->andReturn(true);

        $this->assertTrue($model->member_fund_totals());
    }
}
