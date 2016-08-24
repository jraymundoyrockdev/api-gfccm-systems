<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\User::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000000),
        'member_id' => $faker->numberBetween(1, 1000000),
        'username' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'status' => 'active',
        'avatar' => 'default-avatar.png'
    ];
});