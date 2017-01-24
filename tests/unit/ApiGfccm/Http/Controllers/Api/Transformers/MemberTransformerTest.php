<?php

use ApiGfccm\Http\Controllers\Api\Transformers\MemberTransformer;
use ApiGfccm\Models\Member;
use ApiGfccm\Models\Ministry;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class MemberTransformerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_transforms_a_member_with_ministry_into_an_api_payload()
    {
        $ministry = factory(Ministry::class)->create();
        $member = factory(Member::class)->make();

        $ministry->members()->attach($member->id);

        $expectedKeys = [
            'id',
            'firstname',
            'lastname',
            'fullname',
            'fullname_with_apellation',
            'middlename',
            'apellation',
            'gender',
            'birthdate',
            'address',
            'phone_mobile',
            'email'
        ];

        $result = (new MemberTransformer())->transform($member);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertNotEmpty($result['ministries']);
    }

    /**
     * @test
     */
    public function it_transforms_a_member_with_no_ministry_into_an_api_payload()
    {
        $member = factory(Member::class)->make();

        $expectedKeys = [
            'id',
            'firstname',
            'lastname',
            'fullname',
            'fullname_with_apellation',
            'middlename',
            'apellation',
            'gender',
            'birthdate',
            'address',
            'phone_mobile',
            'email'
        ];

        $result = (new MemberTransformer())->transform($member);

        $this->assertArrayHasKeys($result, $expectedKeys);
        $this->assertEmpty($result['ministries']);
    }
}
