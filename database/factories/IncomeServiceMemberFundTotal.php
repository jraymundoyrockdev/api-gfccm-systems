<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\IncomeServiceMemberFundTotal::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000),
        'income_service_id' => $faker->numberBetween(1, 1000),
        'member_id' => $faker->numberBetween(1, 1000),
        'tithes' => $faker->numberBetween(1, 1000),
        'offering' => $faker->numberBetween(1, 1000),
        'others' => $faker->numberBetween(1, 1000),
        'total' => $faker->numberBetween(1, 1000)
    ];
});