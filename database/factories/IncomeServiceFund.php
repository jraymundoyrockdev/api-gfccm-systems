<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\IncomeServiceFund::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000),
        'income_service_id' => $faker->numberBetween(1, 1000),
        'member_id' => $faker->numberBetween(1, 1000),
        'fund_id' => $faker->numberBetween(1, 1000),
        'fund_item_id' => $faker->numberBetween(1, 1000),
        'amount' => $faker->randomFloat(),
    ];
});