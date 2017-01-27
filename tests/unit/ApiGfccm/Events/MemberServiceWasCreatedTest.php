<?php

use ApiGfccm\Events\MemberWasCreated;
use Faker\Factory as Faker;

class MemberServiceWasCreatedTest extends TestCase
{
    /** @test */
    public function it_sets_events_properties()
    {
        $faker = Faker::create();

        $id = $faker->numberBetween(1, 10000);
        $firstName = $faker->firstName;
        $lastName = $faker->lastName;

        $event = new MemberWasCreated($id, $firstName, $lastName);

        $this->assertEquals($id, $event->id);
        $this->assertEquals($firstName, $event->firstName);
        $this->assertEquals($lastName, $event->lastName);
    }
}
