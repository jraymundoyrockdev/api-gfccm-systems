<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceMemberFundWasUpdated;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;

class SumIncomeServiceFund
{
    /**
     * @var IncomeServiceRepositoryInterface
     */
    protected $incomeService;

    /**
     * Create the event listener.
     *
     * @param IncomeServiceRepositoryInterface $incomeService
     */
    public function __construct(IncomeServiceRepositoryInterface $incomeService)
    {
        $this->incomeService = $incomeService;
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
            'tithes' => $event->tithes,
            'offering' => $event->offering,
            'other_fund' => $event->others,
            'total' => $event->total
        ];

        $this->incomeService->updateFunds($event->incomeServiceId, $payload);

        return $this->incomeService->show($event->incomeServiceId);
    }
}
