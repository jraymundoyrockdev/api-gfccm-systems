<?php

use ApiGfccm\Models\Member;

class MinistryTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_many_member_ministries()
    {
        $model = Mockery::mock('ApiGfccm\Models\Ministry[belongsToMany]');
        $model->shouldReceive('belongsToMany')->with(Member::class)->andReturn(true);

        $this->assertTrue($model->members());
    }
}
