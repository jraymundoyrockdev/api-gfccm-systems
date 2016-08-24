<?php

use ApiGfccm\Models\Member;
use Faker\Factory as Faker;

trait MemberTestsHelper
{
    /**
     * @return array
     */
    public function invalidCreateMemberInput()
    {
        $faker = (new Faker)->create();

    }

    /**
     * Creates new FundItem
     *
     * @param int $count
     * @param array $attributes
     * @return mixed
     */
    private function createMember($count = 1, $attributes = [])
    {
        return factory(Member::class, $count)->create($attributes);
    }

}