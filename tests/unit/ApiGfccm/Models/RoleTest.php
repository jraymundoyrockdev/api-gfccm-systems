<?php

use ApiGfccm\Models\User;

class RoleTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_many_users()
    {
        $model = Mockery::mock('ApiGfccm\Models\Role[belongsToMany]');
        $model->shouldReceive('belongsToMany')->with(User::class, 'user_roles')->andReturn(true);

        $this->assertTrue($model->users());
    }
}
