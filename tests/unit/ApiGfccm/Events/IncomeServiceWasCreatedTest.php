<?php

use ApiGfccm\Events\IncomeServiceWasCreated;
use Faker\Factory as Faker;

class IncomeServiceWasCreatedTest extends TestCase
{
    /** @test */
    public function it_sets_income_service_id()
    {
        $faker = Faker::create();

        $incomeServiceId = $faker->numberBetween(1, 10000);

        $event = new IncomeServiceWasCreated($incomeServiceId);

        $this->assertEquals($incomeServiceId, $event->incomeServiceId);
    }
}
