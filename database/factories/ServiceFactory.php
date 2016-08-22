<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\Service::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 10000),
        'name' => $faker->name,
        'start_time' => $faker->time('H:i'),
        'end_time' => $faker->time('H:i'),
        'description' => $faker->paragraph,
    ];
});