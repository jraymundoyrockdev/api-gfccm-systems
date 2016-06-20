<?php

use ApiGfccm\Models\Denomination;
use ApiGfccm\Repositories\Eloquent\DenominationRepositoryEloquent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;


class DenominationRepositoryEloquentTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_returns_all_denominations()
    {
        $denomination = factory(Denomination::class, 1)->create();

        $repository = $this->app->make(DenominationRepositoryEloquent::class);
        $result = $repository->getAllDenomination();

        $this->assertInstanceOf(Denomination::class, $result);
    }

}

