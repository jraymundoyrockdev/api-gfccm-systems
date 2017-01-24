<?php

use ApiGfccm\Models\IncomeServiceMemberFundTotal;
use ApiGfccm\Models\Ministry;
use ApiGfccm\Models\User;

class MemberTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_a_user()
    {
        $model = Mockery::mock('ApiGfccm\Models\Member[belongsTo]');
        $model->shouldReceive('belongsTo')->with(User::class)->andReturn(true);

        $this->assertTrue($model->user());
    }

    /**
     * @test
     */
    public function it_belongs_to_many_member_ministries()
    {
        $model = Mockery::mock('ApiGfccm\Models\Member[belongsToMany]');
        $model->shouldReceive('belongsToMany')->with(Ministry::class, 'member_ministries')->andReturnSelf();
        $model->shouldReceive('withTimestamps')->andReturn(true);

        $this->assertTrue($model->ministries());
    }

    /**
     * @test
     */
    public function it_has_many_income_service_member_fund_total()
    {
        $model = Mockery::mock('ApiGfccm\Models\Member[hasMany]');
        $model->shouldReceive('hasMany')->with(IncomeServiceMemberFundTotal::class)->andReturn(true);

        $this->assertTrue($model->income_service_member_fund_total());
    }
}

