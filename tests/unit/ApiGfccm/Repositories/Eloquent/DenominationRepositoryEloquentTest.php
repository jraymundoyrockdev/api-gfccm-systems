<?php

use ApiGfccm\Models\Denomination;
use ApiGfccm\Repositories\Eloquent\DenominationRepositoryEloquent;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DenominationRepositoryEloquentTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, DenominationTestsHelper;

    /** @test */
    public function it_returns_denominations_order_by_amount()
    {
        $denominations = $this->createDenomination(10);
        $newDenominations = [];

        foreach ($denominations as $denomination) {
            $newDenominations[$denomination->amount] = $denomination;
        }
        
        krsort($newDenominations);

        $repository = $this->app->make(DenominationRepositoryEloquent::class);

        $result = $repository->allOrderByAmount();

        $lastDenominationAmount = end($newDenominations);

        $this->assertEquals($result[0]->amount, $lastDenominationAmount->amount);
        $this->assertInstanceOf(Denomination::class, $result[0]);
    }

    /** @test */
    public function it_returns_denominations()
    {
        $this->createDenomination(10);

        $repository = $this->app->make(DenominationRepositoryEloquent::class);

        $result = $repository->all();

        $this->assertEquals(10, count($result));
        $this->assertInstanceOf(Denomination::class, $result[0]);
    }

    /** @test */
    public function it_returns_denomination_when_fetched_by_id()
    {
        $denomination = $this->createDenomination();

        $repository = $this->app->make(DenominationRepositoryEloquent::class);

        $result = $repository->findById($denomination->id);

        $this->assertEquals($denomination->id, $result->id);
        $this->assertEquals($denomination->amount, $result->amount);
        $this->assertEquals($denomination->description, $result->description);
        $this->assertArrayHasOnlyKeys($result->toArray(), ['id', 'amount', 'description', 'created_at', 'updated_at']);
        $this->assertInstanceOf(Denomination::class, $result);
    }

    /** @test */
    public function it_returns_exception_when_denomination_does_not_exists()
    {
        $repository = $this->app->make(DenominationRepositoryEloquent::class);

        $result = $repository->findById(0);

        $this->assertEquals(null, $result);
    }

    /** @test */
    public function it_returns_denomination_when_the_denomination_is_updated()
    {
        $faker = (new Faker)->create();
        $denomination = $this->createDenomination();

        $repository = $this->app->make(DenominationRepositoryEloquent::class);

        $denomination = $repository->update($denomination->id, [
            'amount' => $faker->numberBetween(1, 1000),
            'description' => $faker->sentence
        ]);

        $this->seeInDatabase('denominations', [
            'amount' => $denomination->amount,
            'description' => $denomination->description
        ]);

        $this->assertInstanceOf(Denomination::class, $denomination);
    }

    /** @test */
    public function it_returns_null_when_denomination_not_found()
    {
        $faker = (new Faker)->create();

        $repository = $this->app->make(DenominationRepositoryEloquent::class);

        $result = $repository->update(0, [
            'amount' => $faker->numberBetween(1, 1000),
            'description' => $faker->sentence
        ]);

        $this->assertEquals(null, $result);
    }

    /** @test */
    public function it_returns_denomination_when_a_new_denomination_is_created()
    {
        $input = factory(Denomination::class)->make();
        $repository = $this->app->make(DenominationRepositoryEloquent::class);
        $denomination = $repository->create($input->toArray());

        $this->seeInDatabase('denominations', [
            'amount' => $denomination->amount,
            'description' => $denomination->description
        ]);

        $this->assertInstanceOf(Denomination::class, $denomination);
    }
}
