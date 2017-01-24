<?php

use ApiGfccm\Http\Controllers\Api\Transformers\IncomeServiceListTransformer;
use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\Member;
use ApiGfccm\Models\Service;
use ApiGfccm\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class IncomeServiceListTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /** @test */
    public function it_transform_income_service_list_into_an_api_payload()
    {
        $service = factory(Service::class)->create();
        $member = factory(Member::class)->create();
        $user = factory(User::class)->create(['member_id' => $member->id]);

        $incomeServiceList = factory(IncomeService::class)->make([
            'service_id' => $service->id,
            'created_by' => $user->id
        ]);

        $expectedKeys = [
            'id',
            'service_id',
            'tithes',
            'offering',
            'other_fund',
            'total',
            'service_date',
            'service_start_time',
            'service_end_time',
            'status',
            'created_by',
            'updated_at',
            'role_access',
            'service_name',
            'user'
        ];

        $result = new IncomeServiceListTransformer();
        $result = $result->transform($incomeServiceList);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
    }
}