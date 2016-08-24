<?php

/**
 * @var $factory Illuminate\Database\Eloquent\Factory
 */
$factory->define(\ApiGfccm\Models\Member::class, function (\Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(1, 1000000),
        'apellation' => $faker->numberBetween(1, 10000),
        'firstname' => $faker->firstName,
        'middlename' => $faker->lastName,
        'lastname' => $faker->lastName,
        'gender' => $faker->randomElement(['M', 'F']),
        'birthdate' => $faker->date(),
        'address' => $faker->address,
        'phone_mobile' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});