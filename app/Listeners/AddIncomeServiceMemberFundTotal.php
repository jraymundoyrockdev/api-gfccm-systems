<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceMemberFundWasUpdated;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;

class AddIncomeServiceMemberFundTotal
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
     * @param  IncomeServiceMemberFundWasUpdated $event
     * @return void
     */
    public function handle(IncomeServiceMemberFundWasUpdated $event)
    {
        $payload = [
            'income_service_id' => $event->incomeServiceId,
            'member_id' => $event->memberId,
            'tithes' => $event->tithes,
            'offering' => $event->offering,
            'others' => $event->others,
            'total' => $event->total
        ];

        return $this->memberFund->createTotal($payload);
    }
}
