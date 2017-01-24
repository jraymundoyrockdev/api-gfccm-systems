<?php

use ApiGfccm\Http\Controllers\Api\Transformers\IncomeServiceTransformer;
use ApiGfccm\Models\Denomination;
use ApiGfccm\Models\Fund;
use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\IncomeServiceDenomination;
use ApiGfccm\Models\IncomeServiceFundStructure;
use ApiGfccm\Models\IncomeServiceMemberFundTotal;
use ApiGfccm\Models\Member;
use ApiGfccm\Models\Service;
use ApiGfccm\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServiceTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /** @test */
    public function it_transform_income_service_into_an_api_payload()
    {
        $member = factory(Member::class)->create();
        $user = factory(User::class)->create(['member_id' => $member->id]);

        $service = factory(Service::class)->create();
        $incomeService = factory(IncomeService::class)->make(['service_id' => $service->id, 'created_by' => $user->id]);

        $fund = factory(Fund::class)->create();
        factory(IncomeServiceFundStructure::class)->create([
            'income_service_id' => $incomeService->id,
            'fund_id' => $fund->id,
        ]);

        $denomination = factory(Denomination::class)->create();
        factory(IncomeServiceDenomination::class)->create([
            'income_service_id' => $incomeService->id,
            'denomination_id' => $denomination->id
        ]);

        factory(IncomeServiceMemberFundTotal::class)->make([
            'income_service_id' => $incomeService->id,
            'member_id' => $member->id
        ]);

        $expectedKeys = [
            'id',
            'service_id',
            'tithes',
            'offering',
            'other_fund',
            'total',
            'service_date',
            'status',
            'created_by',
            'role_access',
            'service',
            'user',
            'funds_structure',
            'denominations_structure',
            'member_fund_total'
        ];

        $result = new IncomeServiceTransformer();
        $result = $result->transform($incomeService);

        $this->assertArrayHasKeys($result, $expectedKeys);
    }
}