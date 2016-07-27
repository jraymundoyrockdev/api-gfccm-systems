<?php

use ApiGfccm\Http\Controllers\Api\Transformers\DenominationTransformer;
use ApiGfccm\Models\Denomination;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

/**
 * Class DenominationTransformerTest
 */
class DenominationTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_transforms_a_denomination_into_an_api_payload()
    {
        $denomination = factory(Denomination::class)->make();

        $expectedKeys = ['id', 'amount', 'description'];

        $result = (new DenominationTransformer())->transform($denomination);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected($expectedKeys, $denomination, $result);
    }

}