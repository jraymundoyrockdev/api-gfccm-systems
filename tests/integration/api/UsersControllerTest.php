<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use MemberTestsHelper;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use UserTestHelper;

class UsersControllerTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration, UserTestHelper, MemberTestsHelper;

    /** @test */
    public function it_returns_a_user()
    {
        $member = $this->createMember();
        $user = $this->createUser(1, ['member_id' => $member->id]);
        $this->get('api/users/' . $user->id);

        $result = $this->getFirstKey($this->getContent('User'));

        $this->assertEquals($user->id, $result->id);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_error_if_a_user_does_not_exist()
    {
        $this->get('api/users/unknownId');

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_a_collection_of_users()
    {
        $member = $this->createMember();
        $this->createUser(5, ['member_id' => $member->id]);

        $this->get('api/users');

        $result = $this->getContent('Users');

        $this->assertEquals(5, count($result));
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_empty_collection_when_users_does_not_exist()
    {
        $this->get('api/users');

        $this->assertEmpty($this->getContent('Users'));
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_a_user_on_update()
    {
        $member = $this->createMember();
        $user = $this->createUser(1, ['member_id' => $member->id]);

        $inputForUpdate = ['status' => 'inactive', 'avatar' => 'sample.png'];
        $this->put('api/users/' . $user->id, $inputForUpdate);

        $result = $this->getFirstKey($this->getContent('User'));

        $this->assertResponseOk();
        $this->attributeValuesEqualsToExpected(['status', 'avatar'], $inputForUpdate, $result);
    }

    /** @test */
    public function it_returns_error_on_update_if_a_user_tries_to_modify_member_id()
    {
        $member = $this->createMember();
        $memberForUpdate = $this->createMember();
        $user = $this->createUser(1, ['member_id' => $member->id]);

        $inputForUpdate = ['member_id' => $memberForUpdate->id];
        $this->put('api/users/' . $user->id, $inputForUpdate);

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_error_on_update_if_a_user_does_not_exist()
    {
        $this->put('api/users/unknownId');

        $this->assertResponseStatus(404);
    }
}