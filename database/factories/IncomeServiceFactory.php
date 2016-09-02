<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\IncomeService::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 100000),
        'service_id' => $faker->numberBetween(1, 100000),
        'tithes' => $faker->randomFloat(2),
        'offering' => $faker->randomFloat(2),
        'other_fund' => $faker->randomFloat(2),
        'service_date' => $faker->date(),
        'total' => $faker->randomFloat(2),
        'status' => $faker->randomElement(['active', 'inactive']),
        'created_by' => $faker->randomDigit
    ];
});