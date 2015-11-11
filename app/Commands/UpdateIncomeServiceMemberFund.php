<?php namespace ApiGfccm\Commands;

class UpdateIncomeServiceMemberFund extends Command
{

    public $memberFund;

    /**
     * Create a new command instance.
     *
     * @param $memberFund
     */
    public function __construct($memberFund)
    {
        $this->memberFund = $memberFund;
    }
}
