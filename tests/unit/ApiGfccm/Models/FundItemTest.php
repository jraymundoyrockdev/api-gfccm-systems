<?php

use ApiGfccm\Models\Fund;

class FundItemTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_belongs_to_a_fund()
    {
        $model = Mockery::mock('ApiGfccm\Models\FundItem[belongsTo]');
        $model->shouldReceive('belongsTo')->with(Fund::class)->andReturn(true);

        $this->assertTrue($model->fund());
    }
}

