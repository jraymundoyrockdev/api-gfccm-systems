<?php namespace ApiGfccm\Commands;

class DeleteIncomeServiceMemberFundTotal extends Command
{
    /**
     * @var int
     */
    public $incomerServiceId;

    /**
     * @var int
     */
    public $memberId;

    /**
     * @var string
     */
    public $arithmeticOperatorName = 'subtraction';

    /**
     * Create a new command instance.
     *
     * @param $incomerServiceId
     * @param $memberId
     */
    public function __construct($incomerServiceId, $memberId)
    {
        $this->incomeServiceId = $incomerServiceId;
        $this->memberId = $memberId;
    }
}
