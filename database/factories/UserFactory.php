<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\User::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1000, 2000),
        'username' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'status' => 'active',
        'avatar' => 'default-avatar.png',
        'updated_at' => $faker->dateTime
    ];
});