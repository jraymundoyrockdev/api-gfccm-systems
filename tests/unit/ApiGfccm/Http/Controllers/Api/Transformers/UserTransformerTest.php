<?php

use ApiGfccm\Http\Controllers\Api\Transformers\UserTransformer;
use ApiGfccm\Models\Member;
use ApiGfccm\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

/**
 * Class UserTransformerTest
 */
class UserTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /** @test */
    public function it_transforms_a_user_into_an_api_payload()
    {
        $member = factory(Member::class)->create();
        $user = factory(User::class)->make(['member_id' => $member->id]);

        $expectedKeys = ['id', 'username', 'avatar', 'status', 'member', 'role'];

        $result = (new UserTransformer())->transform($user);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->assertEquals($member->id, $user['member']['id']);
        $this->attributeValuesEqualsToExpected(['id', 'username', 'status', 'avatar'], $user, $result);
    }

}