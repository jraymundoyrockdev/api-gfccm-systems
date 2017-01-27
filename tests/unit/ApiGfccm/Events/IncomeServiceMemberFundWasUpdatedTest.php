<?php

use ApiGfccm\Events\IncomeServiceMemberFundWasUpdated;
use Faker\Factory as Faker;

class IncomeServiceMemberFundTotalWasUpdatedTest extends TestCase
{
    /** @test */
    public function it_sets_properties_for_member_and_income_service_id()
    {
        $faker = Faker::create();

        $funds = [[
            'member_id' => $faker->numberBetween(1, 10000),
            'income_service_id' => $faker->numberBetween(1, 10000),
            'fund_item_id' => $faker->numberBetween(1, 3),
            'amount' => $faker->numberBetween(1, 10000),
        ]];

        $event = new IncomeServiceMemberFundWasUpdated($funds);

        $this->assertEquals($funds[0]['member_id'], $event->memberId);
        $this->assertEquals($funds[0]['income_service_id'], $event->incomeServiceId);
    }

    /** @test */
    public function it_sets_properties_for_fund_item_type_tithes()
    {
        $faker = Faker::create();

        $funds = [[
            'member_id' => $faker->numberBetween(1, 10000),
            'income_service_id' => $faker->numberBetween(1, 10000),
            'fund_item_id' => 1,
            'amount' => $faker->numberBetween(1, 10000)
        ]];

        $event = new IncomeServiceMemberFundWasUpdated($funds);

        $this->assertEquals($funds[0]['amount'], $event->tithes);
    }

    /** @test */
    public function it_sets_properties_for_fund_item_type_offering()
    {
        $faker = Faker::create();

        $funds = [[
            'member_id' => $faker->numberBetween(1, 10000),
            'income_service_id' => $faker->numberBetween(1, 10000),
            'fund_item_id' => 2,
            'amount' => $faker->numberBetween(1, 10000)
        ]];

        $event = new IncomeServiceMemberFundWasUpdated($funds);

        $this->assertEquals($funds[0]['amount'], $event->offering);
    }

    /** @test */
    public function it_sets_properties_for_fund_item_type_others()
    {
        $faker = Faker::create();

        $memberId = $faker->numberBetween(1, 10000);
        $incomeServiceId = $faker->numberBetween(1, 10000);

        $funds = [
            [
                'member_id' => $memberId,
                'income_service_id' => $incomeServiceId,
                'fund_item_id' => $faker->numberBetween(3, 10),
                'amount' => $faker->numberBetween(1, 10000)
            ],
            [
                'member_id' => $memberId,
                'income_service_id' => $incomeServiceId,
                'fund_item_id' => $faker->numberBetween(3, 10),
                'amount' => $faker->numberBetween(1, 10000)
            ]
        ];

        $othersTotal = $funds[0]['amount'] + $funds[1]['amount'];

        $event = new IncomeServiceMemberFundWasUpdated($funds);

        $this->assertEquals($othersTotal, $event->others);
    }

    /** @test */
    public function it_sets_properties_for_fund_total()
    {
        $faker = Faker::create();

        $memberId = $faker->numberBetween(1, 10000);
        $incomeServiceId = $faker->numberBetween(1, 10000);

        $funds = [
            [
                'member_id' => $memberId,
                'income_service_id' => $incomeServiceId,
                'fund_item_id' => 1,
                'amount' => $faker->numberBetween(1, 10000)
            ],
            [
                'member_id' => $memberId,
                'income_service_id' => $incomeServiceId,
                'fund_item_id' => 2,
                'amount' => $faker->numberBetween(1, 10000)
            ],
            [
                'member_id' => $memberId,
                'income_service_id' => $incomeServiceId,
                'fund_item_id' => $faker->numberBetween(3, 10),
                'amount' => $faker->numberBetween(1, 10000)
            ]
        ];

        $total = $funds[0]['amount'] + $funds[1]['amount'] + $funds[2]['amount'];

        $event = new IncomeServiceMemberFundWasUpdated($funds);

        $this->assertEquals($total, $event->total);
    }
}
