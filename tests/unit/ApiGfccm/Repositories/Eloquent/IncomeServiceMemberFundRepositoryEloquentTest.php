<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServiceMemberFundRepositoryEloquentTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /** @test */
    public function insert_test()
    {

    }
}
