<?php

use ApiGfccm\Http\Controllers\Api\Transformers\MinistryTransactionTransformer;
use ApiGfccm\Models\MinistryTransaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class MinistryTransactionTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /** @test */
    public function it_transform_ministry_transaction_into_an_api_payload()
    {
        $ministryTransaction = factory(MinistryTransaction::class)->make();

        $expectedKeys = [
            'id',
            'ministry_id',
            'type',
            'amount',
            'transaction_date',
            'description',
            'running_balance',
            'document_image'
        ];

        $result = new MinistryTransactionTransformer;
        $result = $result->transform($ministryTransaction);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected($expectedKeys, $ministryTransaction, $result);
    }
}