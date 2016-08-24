<?php

use ApiGfccm\Models\User;
use Faker\Factory as Faker;

trait UserTestHelper
{
    /**
     * Invalid User Create Input
     *
     * @return array
     */
    public function invalidCreateUserInput()
    {
        $faker = (new Faker)->create();
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    private function createUser($count = 1, $attributes = [])
    {
        return factory(User::class, $count)->create($attributes);
    }

}
