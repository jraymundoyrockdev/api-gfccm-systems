<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(ApiGfccm\Models\Role::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000),
        'name' => $faker->name,
        'description' => $faker->sentence
    ];
});
