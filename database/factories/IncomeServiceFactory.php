<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\IncomeService::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 100000),
        'service_id' => $faker->numberBetween(1, 100000),
        'tithes' => $faker->randomFloat(),
        'offering' => $faker->randomFloat(),
        'other_fund' => $faker->randomFloat(),
        'service_date' => $faker->date(),
        'total' => $faker->randomFloat(),
        'status' => $faker->randomElement(['active', 'inactive']),
        'created_by' => $faker->randomDigit
    ];
});