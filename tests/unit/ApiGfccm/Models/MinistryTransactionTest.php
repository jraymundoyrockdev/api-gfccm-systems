<?php

use ApiGfccm\Models\Ministry;

class MinistryTransactionTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_a_ministry()
    {
        $model = Mockery::mock('ApiGfccm\Models\MinistryTransaction[belongsTo]');
        $model->shouldReceive('belongsTo')->with(Ministry::class)->andReturn(true);

        $this->assertTrue($model->ministry());
    }
}

