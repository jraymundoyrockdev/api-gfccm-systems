<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\IncomeService::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 100000),
        'service_id' => $faker->numberBetween(1, 100000),
        'tithes' => $faker->numberBetween(500, 100000),
        'offering' => $faker->numberBetween(500, 100000),
        'other_fund' => $faker->numberBetween(500, 100000),
        'service_date' => $faker->date(),
        'total' => $faker->numberBetween(500, 100000),
        'status' => $faker->randomElement(['active', 'inactive']),
        'created_by' => $faker->randomDigit
    ];
});