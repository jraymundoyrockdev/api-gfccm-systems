<?php

use ApiGfccm\Commands\DeleteIncomeServiceMemberFundTotal;

class DeleteIncomeServiceMemberFundTotalTest extends TestCase
{
    /** @test */
    public function it_instantiates_a_new_command()
    {
        $command = new DeleteIncomeServiceMemberFundTotal(1, 2);

        $this->assertInstanceOf(DeleteIncomeServiceMemberFundTotal::class, $command);
        $this->assertEquals($command->incomeServiceId, 1);
        $this->assertEquals($command->memberId, 2);
    }
}