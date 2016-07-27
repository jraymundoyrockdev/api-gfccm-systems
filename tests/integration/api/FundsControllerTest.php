<?php

use ApiGfccm\Models\Fund;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class FundsControllerTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration, FundTestsHelper, FundItemTestsHelper;

    /** @test */
    public function it_returns_a_collection_of_funds()
    {
        $this->createFund(10);

        $this->get('api/funds');

        $result = $this->getContent('Funds');

        $this->assertEquals(10, count($result));
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_empty_collection_when_no_fund_exists()
    {
        $this->get('api/funds');

        $result = $this->getContent('Funds');

        $this->assertEmpty($result);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_fund_when_fund_is_created()
    {
        $input = factory(Fund::class)->make();

        $this->post('api/funds', $input->toArray());

        $result = $this->getFirstKey($this->getContent('Fund'));
        $this->attributeValuesEqualsToExpected(['name', 'description', 'category'], $input, $result);
        $this->assertResponseOk();
    }

    /**
     * @test
     * @dataProvider invalidCreateFundInput
     */
    public function it_rejects_create_when_input_is_invalid($payload)
    {
        $existingFund = $this->createFund(1, ['name' => 'testName']);

        $this->post('api/funds', $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /**
     * @test
     */
    public function it_return_a_fund()
    {
        $fund = $this->createFund();

        $this->get('api/funds/' . $fund->id);

        $result = $this->getFirstKey($this->getContent('Fund'));

        $this->attributeValuesEqualsToExpected(['name', 'description', 'category'], $fund, $result);
        $this->assertResponseOk();
    }

    /**
     * @test
     */
    public function it_returns_an_invalid_response_when_fund_does_not_exists()
    {
        $this->get('api/funds/0');

        $this->assertResponseStatus(404);
    }

    /**
     * @test
     */
    public function it_returns_a_fund_on_update()
    {
        $fund = $this->createFund();
        $inputForUpdate = (factory(Fund::class)->make())->toArray();

        unset($inputForUpdate['id']);

        $this->put('api/funds/' . $fund->id, $inputForUpdate);

        $result = $this->getFirstKey($this->getContent('Fund'));

        $this->attributeValuesEqualsToExpected(['name', 'description', 'category', 'status'], $inputForUpdate, $result);
        $this->assertResponseOk();
    }

    /**
     * @test
     * @dataProvider invalidCreateFundInput
     */
    public function it_rejects_update_if_input_is_invalid($payload)
    {
        $fund = $this->createFund();
        $existingFund = $this->createFund(1, ['name' => 'testName']);


        $this->put('api/funds/' . $fund->id, $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /**
     * @test
     */
    public function it_return_an_invalid_response_on_update_when_fund_does_not_exists()
    {
        $this->put('api/funds/0', ['name' => 'unknownName']);

        $this->assertResponseStatus(404);
    }

    /**
     * @test
     */
    public function it_returns_an_invalid_response_on_showing_fund_items_in_a_fund_when_fund_does_not_exists()
    {
        $this->get('api/funds/0/items');

        $this->assertResponseStatus(404);
    }

    /**
     * @test
     */
    public function it_returns_an_empty_collection_when_fund_does_not_have_fund_items()
    {
        $fund = $this->createFund();

        $this->get('api/funds/' . $fund->id . '/items');

        $result = $this->getContent('FundItems');

        $this->assertEmpty($result);
        $this->assertResponseOk();
    }

    /**
     * @test
     */
    public function it_returns_a_collection_of_fund_items_associated_in_a_fund()
    {
        $fund = $this->createFundWithFundItems(1, 5);

        $this->get('api/funds/' . $fund->id . '/items');

        $result = $this->getContent('FundItems');

        $this->assertEquals($fund->id, $result[0]->fund->id);
        $this->assertEquals(5, count($result));
        $this->assertResponseOk();
    }

}