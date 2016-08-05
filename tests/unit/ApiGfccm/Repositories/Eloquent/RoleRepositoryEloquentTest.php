<?php

use ApiGfccm\Models\Role;
use ApiGfccm\Repositories\Eloquent\RoleRepositoryEloquent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleRepositoryEloquentTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, DenominationTestsHelper, RoleTestsHelper;

    protected $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = $this->app->make(RoleRepositoryEloquent::class);
    }

    /** @test */
    public function it_returns_roles()
    {
        $this->createRole(10);

        $result = $this->repository->all();

        $this->assertEquals(10, count($result->toArray()));
        $this->assertInstanceOf(Role::class, $result[0]);
    }

    /** @test */
    public function it_returns_empty_data_if_roles_are_empty()
    {
        $result = $this->repository->all();

        $this->assertEmpty($result);
    }


    /** @test */
    public function it_return_role_when_find_by_id()
    {
        $role = $this->createRole(1);

        $result = $this->repository->findById($role->id);

        $this->assertInstanceof(Role::class, $result);
        $this->attributeValuesEqualsToExpected(['name', 'description'], $role, $result);
        $this->assertArrayHasOnlyKeys($result->toArray(), ['id', 'name', 'description', 'created_at', 'updated_at']);
    }

    /** @test */
    public function it_returns_null_when_role_does_not_exists()
    {
        $result = $this->repository->findById('unknownId');

        $this->assertNull($result);
    }
}