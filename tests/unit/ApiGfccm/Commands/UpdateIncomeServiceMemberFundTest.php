<?php

use ApiGfccm\Commands\UpdateIncomeServiceMemberFund;
use ApiGfccm\Models\IncomeServiceMemberFund;

class UpdateIncomeServiceMemberFundTest extends TestCase
{
    /** @test */
    public function it_instantiates_a_new_command()
    {
        $input = factory(IncomeServiceMemberFund::class)->make();
        $command = new UpdateIncomeServiceMemberFund($input->toArray());

        $this->assertInstanceOf(UpdateIncomeServiceMemberFund::class, $command);
        $this->assertEquals($command->incomeServiceMemberFund, $input->toArray());
    }
}