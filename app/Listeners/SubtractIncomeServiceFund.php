<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceMemberFundTotalWasDeleted;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;

class SubtractIncomeServiceFund
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
     * @param  IncomeServiceMemberFundTotalWasDeleted $event
     * @return void
     */
    public function handle(IncomeServiceMemberFundTotalWasDeleted $event)
    {
        $payload = [
            'tithes' => $event->tithes,
            'offering' => $event->offering,
            'other_fund' => $event->others,
            'total' => $event->total
        ];

        $this->incomeService->updateFunds($event->incomeServiceId, $payload, 'subtraction');

        return $this->incomeService->show($event->incomeServiceId);
    }
}
