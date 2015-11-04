<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\IncomeServiceDenominationStructure::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000),
        'income_service_id' => $faker->numberBetween(1, 1000),
        'denomination_id' => $faker->numberBetween(1, 1000),
        'amount' => $faker->randomFloat(),
    ];
});