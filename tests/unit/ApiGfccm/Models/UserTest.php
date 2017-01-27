<?php

use ApiGfccm\Models\Member;
use ApiGfccm\Models\Role;

class UserTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_a_member()
    {
        $model = Mockery::mock('ApiGfccm\Models\User[belongsTo]');
        $model->shouldReceive('belongsTo')->with(Member::class)->andReturn(true);

        $this->assertTrue($model->member());
    }

    /**
     * @test
     */
    public function it_belongs_to_many_roles()
    {
        $model = Mockery::mock('ApiGfccm\Models\User[belongsToMany]');
        $model->shouldReceive('belongsToMany')->with(Role::class, 'user_roles')->andReturnSelf();
        $model->shouldReceive('withTimestamps')->andReturn(true);

        $this->assertTrue($model->roles());
    }
}
