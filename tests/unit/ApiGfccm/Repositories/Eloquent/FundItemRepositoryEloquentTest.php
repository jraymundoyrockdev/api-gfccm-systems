<?php

use ApiGfccm\Models\Fund;
use ApiGfccm\Models\FundItem;
use ApiGfccm\Repositories\Eloquent\FundItemRepositoryEloquent;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FundItemRepositoryEloquentTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, FundTestsHelper, FundItemTestsHelper;

    /** @test */
    public function it_returns_fund_items()
    {
        $fund = $this->createFund();
        $this->createFundItem(10, ['fund_id' => $fund->id]);

        $repository = $this->app->make(FundItemRepositoryEloquent::class);

        $result = $repository->all();

        $this->assertEquals(10, count($result));
        $this->assertInstanceOf(FundItem::class, $result[0]);
    }

    /** @test */
    public function it_returns_empty_when_fund_items_are_not_found()
    {
        $repository = $this->app->make(FundItemRepositoryEloquent::class);
        $this->assertEmpty($repository->all());
    }

    /** @test */
    public function it_returns_a_fund_item_when_fetched_by_id()
    {
        $fund = $this->createFund();
        $fundItem = $this->createFundItem(1, ['fund_id' => $fund->id]);

        $repository = $this->app->make(FundItemRepositoryEloquent::class);

        $result = $repository->findById($fundItem->id);

        $this->assertArrayHasOnlyKeys($result->toArray(),
            ['id', 'fund_id', 'name', 'status', 'created_at', 'updated_at']);
        $this->attributeValuesEqualsToExpected(['id', 'fund_id', 'name', 'status'], $fundItem, $result);
        $this->assertInstanceOf(FundItem::class, $result);
    }

    /** @test */
    public function it_return_null_when_fund_item_is_not_found()
    {
        $repository = $this->app->make(FundItemRepositoryEloquent::class);
        $this->assertNull($repository->findById(0));
    }

    /** @test */
    public function it_returns_fund_items_which_belonged_to_a_fund()
    {
        $fund = $this->createFund();
        $this->createFundItem(5, ['fund_id' => $fund->id]);

        $repository = $this->app->make(FundItemRepositoryEloquent::class);

        $result = $repository->findByFundId($fund->id);

        $this->assertEquals($fund->id, $result[0]->fund_id);
        $this->assertEquals(5, count($result));
        $this->assertInstanceOf(FundItem::class, $result[0]);
    }

    /** @test */
    public function it_returns_empty_when_there_is_no_fund_items_associated_by_fund()
    {
        $repository = $this->app->make(FundItemRepositoryEloquent::class);
        $this->assertEmpty($repository->findByFundId(new Fund()));
    }

    /** @test */
    public function it_returns_a_fund_item_when_created()
    {
        $fund = $this->createFund();
        $input = factory(FundItem::class)->make(['fund_id' => $fund->id]);

        $repository = $this->app->make(FundItemRepositoryEloquent::class);

        $result = $repository->create($input->toArray());

        $this->seeInDatabase('fund_items', [
            'fund_id' => $input->fund_id,
            'name' => $input->name,
            'status' => $input->status
        ]);

        $this->assertInstanceOf(FundItem::class, $result);
    }

    /** @test */
    public function it_returns_a_fund_item_when_updated()
    {
        $faker = (new Faker)->create();

        $fund = $this->createFund();
        $updatedFund = $this->createFund();
        $fundItem = $this->createFundItem(1, ['fund_id' => $fund->id]);

        $repository = $this->app->make(FundItemRepositoryEloquent::class);

        $updatedInput = [
            'fund_id' => $updatedFund->id,
            'name' => $faker->word,
            'status' => $faker->randomElement(['active', 'inactive'])
        ];

        $result = $repository->update($fundItem->id, $updatedInput);

        $this->seeInDatabase('fund_items', [
            'fund_id' => $updatedInput['fund_id'],
            'name' => $updatedInput['name'],
            'status' => $updatedInput['status']
        ]);

        $this->attributeValuesEqualsToExpected(['fund_id', 'name', 'status'], $updatedInput, $result);
        $this->assertInstanceOf(FundItem::class, $result);
    }

    /** @test */
    public function it_returns_empty_on_update_when_fund_item_does_not_exists()
    {
        $repository = $this->app->make(FundItemRepositoryEloquent::class);
        $result = $repository->update(0, []);

        $this->assertEquals(null, $result);
    }

    /** @test */
    public function it_returns_active_fund_items()
    {
        $fund = $this->createFund();
        $this->createFundItem(10, ['fund_id' => $fund->id]);

        $repository = $this->app->make(FundItemRepositoryEloquent::class);

        $result = $repository->getActive();

        foreach ($result as $res) {
            $this->assertEquals('active', $res->status);
        }

        $this->assertInstanceOf(FundItem::class, $result[0]);
    }
}