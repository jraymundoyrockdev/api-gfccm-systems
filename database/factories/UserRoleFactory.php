<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\UserRole::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000000),
        'user_id' => $faker->numberBetween(1, 1000000),
        'role_id' => $faker->numberBetween(1, 1000000)
    ];
});
