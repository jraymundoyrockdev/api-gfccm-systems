<?php namespace ApiGfccm\Commands;

class UpdateIncomeServiceMemberFund extends Command
{

    /**
     * @var array
     */
    public $incomeServiceMemberFund;

    /**
     * Create a new command instance.
     *
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->incomeServiceMemberFund = $input;
    }
}
