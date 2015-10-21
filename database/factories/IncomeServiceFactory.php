<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */

$factory->define(\ApiGfccm\Models\IncomeService::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->randomDigit,
        'service_id' => $faker->randomDigit,
        'tithes' => $faker->randomFloat(),
        'offering' => $faker->randomFloat,
        'other_fund' => $faker->randomFloat,
        'service_date' => $faker->dateTime,
        'status' => $faker->randomElement(['active', 'inactive']),
        'created_by' => $faker->randomDigit,
        'role_access' => $faker->randomDigit,
    ];
});