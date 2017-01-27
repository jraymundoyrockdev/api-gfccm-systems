<?php

use ApiGfccm\Events\IncomeServiceMemberFundTotalWasDeleted;
use Faker\Factory as Faker;

class IncomeServiceMemberFundTotalWasDeletedTest extends TestCase
{
    /** @test */
    public function it_sets_properties_of_the_income_service_member_fund_total_was_deleted_event()
    {
        $faker = Faker::create();

        $incomeServiceId = $faker->numberBetween(1, 10000);
        $memberId = $faker->numberBetween(1, 10000);
        $tithes = $faker->numberBetween(1, 10000);
        $offering = $faker->numberBetween(1, 10000);
        $others = $faker->numberBetween(1, 10000);
        $total = $faker->numberBetween(1, 10000);

        $event = new IncomeServiceMemberFundTotalWasDeleted(
            $incomeServiceId,
            $memberId,
            $tithes,
            $offering,
            $others,
            $total
        );

        $this->assertEquals($incomeServiceId, $event->incomeServiceId);
        $this->assertEquals($memberId, $event->memberId);
        $this->assertEquals($tithes, $event->tithes);
        $this->assertEquals($offering, $event->offering);
        $this->assertEquals($others, $event->others);
        $this->assertEquals($total, $event->total);
    }
}
