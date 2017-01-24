<?php

use ApiGfccm\Http\Controllers\Api\Transformers\IncomeServiceMemberFundTotalTransformer;
use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\IncomeServiceMemberFundTotal;
use ApiGfccm\Models\Member;
use ApiGfccm\Models\Service;
use ApiGfccm\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServiceFundMemberFundTotalTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /** @test */
    public function it_transform_income_service_member_fund_total_transformer_into_an_api_payload()
    {

        $service = factory(Service::class)->create();
        $incomeService = factory(IncomeService::class)->create(['service_id' => $service->id]);
        $member = factory(Member::class)->create();
        $user = factory(User::class)->create(['member_id' => $member->id]);
        $incomeServiceMemberFundTotal = factory(IncomeServiceMemberFundTotal::class)->create([
            'member_id' => $member->id,
            'income_service_id' => $incomeService->id
        ]);

        $expectedKeys = [
            'id',
            'income_service_id',
            'member_id',
            'member',
            'tithes',
            'offering',
            'others',
            'total'
        ];

        $result = new IncomeServiceMemberFundTotalTransformer();
        $result = $result->transform($incomeServiceMemberFundTotal);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
    }
}