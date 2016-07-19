<?php

use ApiGfccm\Models\FundItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class FundItemsControllerTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration, FundTestsHelper, FundItemTestsHelper;

    /** @test */
    public function it_returns_fund_item_when_created()
    {
        $fund = $this->createNewFund();
        $input = factory(FundItem::class)->make(['fund_id' => $fund->id]);

        $this->post('api/fund-items', $input->toArray());

        $result = $this->getFirstKey($this->getContent('FundItem'));

        $this->attributeValuesEqualsToExpected(['fund_id', 'name', 'status'], $input, $result);
        $this->assertResponseOk();
    }

    /**
     * @test
     * @dataProvider invalidCreateFundItemInput
     */
    public function it_rejects_create_if_input_is_invalid($payload)
    {
        $this->post('api/fund-items', $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_returns_fund_item_on_update_if_fund_item_exists()
    {
        $initialFund = $this->createNewFund();
        $initialFundItem = $this->createFundItem(1, ['fund_id' => $initialFund->id]);

        $updatedFund = $this->createNewFund();
        $updatedInput = ['fund_id' => $updatedFund->id, 'name' => 'newName', 'status' => 'active'];

        $this->put('api/fund-items/' . $initialFundItem->id, $updatedInput);

        $result = $this->getFirstKey($this->getContent('FundItem'));

        $this->attributeValuesEqualsToExpected(['fund_id', 'name', 'status'], $updatedInput, $result);
        $this->assertResponseOk();
    }

    /**
     * @test
     * @dataProvider invalidCreateFundItemInput
     */
    public function it_rejects_update_if_updated_input_is_invalid($payload)
    {
        $initialFund = $this->createNewFund();
        $initialFundItem = $this->createFundItem(1, ['fund_id' => $initialFund->id]);

        $this->put('api/fund-items/' . $initialFundItem->id, $payload, ['accept' => 'application/json']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_returns_an_invalid_response_on_update_if_fund_item_does_not_exists()
    {
        $updatedInput = ['fund_id' => 2, 'name' => 'newName', 'status' => 'active'];

        $this->put('api/fund-items/0', $updatedInput);

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_a_fund_item_if_exists()
    {
        $initialFund = $this->createNewFund();
        $initialFundItem = $this->createFundItem(1, ['fund_id' => $initialFund->id]);

        $this->get('api/fund-items/' . $initialFundItem->id);

        $result = $this->getFirstKey($this->getContent('FundItem'));

        $this->assertObjectHasOnlyAttributes(['id', 'fund_id', 'name', 'status'], $result);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_invalid_response_when_fund_item_does_not_exists()
    {
        $this->get('api/fund-items/0');

        $this->assertResponseStatus(404);
    }
}
