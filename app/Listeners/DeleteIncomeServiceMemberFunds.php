<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceMemberFundTotalWasDeleted;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;

class DeleteIncomeServiceMemberFunds
{
    /**
     * @var IncomeServiceMemberFundRepositoryInterface
     */
    protected $memberFund;

    /**
     * Create the event listener.
     *
     * @param IncomeServiceMemberFundRepositoryInterface $memberFund
     */
    public function __construct(IncomeServiceMemberFundRepositoryInterface $memberFund)
    {
        $this->memberFund = $memberFund;
    }

    /**
     * Handle the event.
     *
     * @param  IncomeServiceMemberFundTotalWasDeleted $event
     * @return void
     */
    public function handle(IncomeServiceMemberFundTotalWasDeleted $event)
    {
        return $this->memberFund->delete($event->incomeServiceId, $event->memberId);
    }
}
