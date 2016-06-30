<?php

use ApiGfccm\Models\Denomination;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DenominationRepositoryEloquentTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function testExample()
    {
        $denomination = factory(Denomination::class)->create();

        $this->seeInDatabase('denominations', ['amount' => $denomination->amount]);
    }
}
