<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\IncomeServiceFundStructure::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000),
        'income_service_id' => $faker->numberBetween(1, 1000),
        'fund_id' => $faker->numberBetween(1, 1000),
        'name' => $faker->word
    ];
});