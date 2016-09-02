<?php

use ApiGfccm\Models\FundItem;

class FundTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_has_many_items()
    {
        $model = Mockery::mock('ApiGfccm\Models\Fund[hasMany]');
        $model->shouldReceive('hasMany')->with(FundItem::class)->andReturn(true);

        $this->assertTrue($model->items());
    }
}

