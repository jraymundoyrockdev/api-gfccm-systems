<?php namespace ApiGfccm\Commands;

class DeleteIncomeServiceMemberFundTotal extends Command
{
    /**
     * @var int
     */
    public $incomeServiceId;

    /**
     * @var int
     */
    public $memberId;

    /**
     * Create a new command instance.
     *
     * @param $incomeServiceId
     * @param $memberId
     */
    public function __construct($incomeServiceId, $memberId)
    {
        $this->incomeServiceId = $incomeServiceId;
        $this->memberId = $memberId;
    }
}
