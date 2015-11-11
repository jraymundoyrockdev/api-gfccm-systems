<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceMemberFundWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;

class UpdateIncomeServiceFund
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
        //
        $this->incomeService = $incomeService;
    }

    /**
     * Handle the event.
     *
     * @param  IncomeServiceMemberFundWasUpdated  $event
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

        $this->incomeService->updateFunds($event->incomeServiceId,$payload);

        $payload['id'] = $event->incomeServiceId;

        return $payload;
    }
}
