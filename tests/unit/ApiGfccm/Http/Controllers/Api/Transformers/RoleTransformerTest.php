<?php

use ApiGfccm\Http\Controllers\Api\Transformers\RoleTransformer;
use ApiGfccm\Models\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

/**
 * Class FundTransformerTest
 */
class RoleTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_transforms_a_role_into_an_api_payload()
    {
        $role = factory(Role::class)->make();

        $expectedKeys = ['id', 'name', 'description'];

        $result = (new RoleTransformer)->transform($role);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertArrayHasOnlyKeys($result, $expectedKeys);
        $this->attributeValuesEqualsToExpected($expectedKeys, $role, $result);
    }

}