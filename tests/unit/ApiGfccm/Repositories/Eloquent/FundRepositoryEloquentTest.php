<?php

use ApiGfccm\Models\Fund;
use ApiGfccm\Models\FundItem;
use ApiGfccm\Repositories\Eloquent\FundRepositoryEloquent;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FundRepositoryEloquentTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, FundTestsHelper, FundItemTestsHelper;

    /** @test */
    public function it_returns_fund_with_items()
    {
        $this->createFundWithFundItems(5, 5);

        $repository = $this->app->make(FundRepositoryEloquent::class);

        $result = $repository->all();

        $this->assertEquals(5, count($result));
        $this->assertEquals(5, count($result[0]->item));
        $this->assertInstanceOf(Fund::class, $result[0]);
        $this->assertInstanceOf(FundItem::class, $result[0]->item[0]);
    }

    /** @test */
    public function it_returns_empty_if_funds_are_empty()
    {
        $repository = $this->app->make(FundRepositoryEloquent::class);

        $result = $repository->all();

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_fund_if_fund_exists()
    {
        $fund = $this->createFundWithFundItems(1, 1);

        $repository = $this->app->make(FundRepositoryEloquent::class);

        $result = $repository->findById($fund->id);

        $this->assertInstanceOf(Fund::class, $result);
        $this->assertEquals($fund->id, $result->id);
    }

    /** @test */
    public function it_returns_null_if_fund_does_not_exists()
    {
        $repository = $this->app->make(FundRepositoryEloquent::class);

        $result = $repository->findById(0);

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_fund_when_fund_is_created()
    {
        $input = factory(Fund::class)->make();

        $repository = $this->app->make(FundRepositoryEloquent::class);

        $result = $repository->create($input->toArray());

        $this->seeInDatabase('funds', [
            'name' => $input['name'],
            'description' => $input['description'],
            'category' => $input['category'],
            'status' => $input['status']
        ]);

        $this->assertInstanceOf(Fund::class, $result);
    }

    /** @test */
    public function it_returns_fund_when_fund_is_updated()
    {
        $faker = (new Faker)->create();

        $fund = $this->createFundWithFundItems(1, 1, ['category' => 'service', 'status' => 'active']);

        $repository = $this->app->make(FundRepositoryEloquent::class);

        $updateInput = [
            'name' => $faker->word,
            'description' => $faker->sentence,
            'category' => 'others',
            'status' => 'inactive'
        ];

        $result = $repository->update($fund->id, $updateInput);

        $this->assertEquals($fund->id, $result->id);
        $this->attributeValuesEqualsToExpected(['name', 'description', 'category', 'status'], $updateInput, $result);
        $this->assertInstanceOf(Fund::class, $result);
    }

    /** @test */
    public function it_returns_null_on_update_if_fund_does_not_exists()
    {
        $repository = $this->app->make(FundRepositoryEloquent::class);

        $result = $repository->update(0, []);

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_active_funds()
    {
        $this->createFundWithFundItems(5, 2, ['status' => 'active']);

        $repository = $this->app->make(FundRepositoryEloquent::class);

        $result = $repository->getActive();

        foreach ($result as $res) {
            $this->assertEquals('active', $res->status);
        }

        $this->assertEquals(5, count($result));
        $this->assertInstanceOf(Fund::class, $result[0]);
    }

}