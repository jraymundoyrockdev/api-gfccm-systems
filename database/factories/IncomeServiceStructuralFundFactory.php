<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\IncomeServiceStructuralFund::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->randomDigit,
        'income_service_id' => $faker->randomDigit,
        'fund_id' => $faker->randomDigit,
        'fund_item_id' => $faker->randomDigit
    ];
});