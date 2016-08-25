<?php

use ApiGfccm\Models\User;
use ApiGfccm\Repositories\Eloquent\UserRepositoryEloquent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryEloquentTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, DenominationTestsHelper, UserTestHelper, MemberTestsHelper;

    protected $repository;

    public function setUp()
    {
        parent::setUp();
        $this->repository = $this->app->make(UserRepositoryEloquent::class);
    }

    /** @test */
    public function it_returns_all_users()
    {
        $member = $this->createMember();
        $this->createUser(5, ['member_id' => $member->id]);

        $result = $this->repository->all();

        $this->assertEquals(5, count($result));
        $this->assertInstanceOf(User::class, $result[0]);
    }

    /** @test */
    public function it_returns_empty_when_there_is_no_user_that_exist()
    {
        $result = $this->repository->all();

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_returns_a_user_when_find_by_id()
    {
        $member = $this->createMember();
        $user = $this->createUser(1, ['member_id' => $member->id]);

        $result = $this->repository->findById($user->id);

        $this->attributeValuesEqualsToExpected([
            'id',
            'member_id',
            'username',
            'status',
            'avatar',
            'updated_at',
            'created_at'
        ], $user, $result);
        $this->assertInstanceOf(User::class, $result);
    }

    /** @test */
    public function it_returns_null_when_user_does_not_exist()
    {
        $result = $this->repository->findById('unknownId');

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_a_user_when_find_by_username()
    {
        $member = $this->createMember();
        $user = $this->createUser(1, ['member_id' => $member->id]);

        $result = $this->repository->findByUsername($user->username);

        $this->attributeValuesEqualsToExpected([
            'id',
            'member_id',
            'username',
            'status',
            'avatar',
            'updated_at',
            'created_at'
        ], $user, $result);
        $this->assertInstanceOf(User::class, $result);
    }

    /** @test */
    public function it_returns_null_when_finding_user_by_username_and_does_not_exist()
    {
        $result = $this->repository->findByUsername('unknownId');

        $this->assertNull($result);
    }


    /** @test */
    public function it_returns_user_after_create()
    {
        $member = $this->createMember();
        $input = factory(User::class)->make(['member_id' => $member->id]);

        $input = array_merge($input->toArray(), ['password' => bcrypt(str_random(10))]);

        $result = $this->repository->create($input);

        $this->assertInstanceOf(User::class, $result);
        $this->attributeValuesEqualsToExpected(['member_id', 'username', 'status', 'avatar'], $input, $result);
        $this->seeInDatabase('users', [
            'member_id' => $input['member_id'],
            'username' => $input['username'],
            'status' => $input['status'],
            'avatar' => $input['avatar']
        ]);
    }

    /** @test */
    public function it_returns_a_user_after_update()
    {
        $member = $this->createMember();
        $user = $this->createUser(1, ['member_id' => $member->id]);

        $editedInput = ['username' => 'someUsername', 'status' => 'inactive', 'avatar' => 'test.png'];

        $result = $this->repository->update($editedInput, $user->id);

        $this->assertInstanceOf(User::class, $result);
        $this->attributeValuesEqualsToExpected(['username', 'status', 'avatar'], $editedInput, $result);
        $this->assertEquals($result->id, $user->id);
        $this->seeInDatabase('users', [
            'username' => $editedInput['username'],
            'status' => $editedInput['status'],
            'avatar' => $editedInput['avatar']
        ]);

    }

    /** @test */
    public function it_returns_null_on_update_if_user_tries_to_update_member_id()
    {
        $member = $this->createMember();
        $user = $this->createUser(1, ['member_id' => $member->id]);

        $editedInput = ['member_id' => 'someMemberId'];

        $result = $this->repository->update($editedInput, $user->id);

        $this->assertNull($result);
    }

    /** @test */
    public function it_returns_null_on_update_when_user_does_not_exist()
    {
        $result = $this->repository->update([], self::UNKNOWN_ID);

        $this->assertNull($result);
    }

}
