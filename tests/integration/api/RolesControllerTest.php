<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class RolesControllerTest extends ApiTestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration, RoleTestsHelper;

    /** @test */
    public function it_returns_a_collection_of_roles()
    {
        $this->createRole(10);

        $this->get('api/roles');

        $result = $this->getContent('Roles');

        $this->assertEquals(10, count($result));
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_empty_role_collection_when_there_is_no_roles()
    {
        $this->get('api/roles');

        $result = $this->getContent('Roles');

        $this->assertEmpty($result);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_a_role()
    {
        $role = $this->createRole(1);

        $this->get('api/roles/' . $role->id);

        $result = $this->getContent('Role');

        $this->attributeValuesEqualsToExpected(['id', 'name', 'description'], $role, $result[0]);
        $this->assertResponseOk();
    }

    /** @test */
    public function it_returns_an_invalid_response_when_specified_role_does_not_exist()
    {
        $this->get('api/roles/unknownId');

        $this->assertResponseStatus(404);
    }
}