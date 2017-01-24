<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\IncomeServiceDenomination::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000),
        'income_service_id' => $faker->numberBetween(1, 1000),
        'denomination_id' => $faker->numberBetween(1, 1000),
        'description' => $faker->sentence,
        'amount' => $faker->randomFloat(),
        'piece' => $faker->numberBetween(1, 500),
        'total' => $faker->numberBetween(1, 5000),
    ];
});