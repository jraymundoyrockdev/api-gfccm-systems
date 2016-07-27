<?php

use ApiGfccm\Http\Controllers\Api\Transformers\FundItemTransformer;
use ApiGfccm\Models\Fund;
use ApiGfccm\Models\FundItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

/**
 * Class FundItemTransformerTest
 */
class FundItemTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_transforms_a_fund_item_into_an_api_payload()
    {
        $fund = factory(Fund::class)->make();
        $fundItem = factory(FundItem::class)->make(['fund' => $fund]);

        $expectedKeys = ['id', 'fund', 'name', 'status'];

        $result = (new FundItemTransformer())->transform($fundItem);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected($expectedKeys, $fundItem, $result);
    }

}