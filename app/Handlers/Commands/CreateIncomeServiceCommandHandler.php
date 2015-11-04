<?php namespace ApiGfccm\Handlers\Commands;

use ApiGfccm\Commands\CreateIncomeServiceCommand;
use ApiGfccm\Events\IncomeServiceWasCreated;
use ApiGfccm\Models\IncomeServiceFundStructure;
use ApiGfccm\Repositories\Eloquent\IncomeServiceRepositoryEloquent;
use Illuminate\Contracts\Events\Dispatcher;

class CreateIncomeServiceCommandHandler
{
    /**
     * @var IncomeServiceRepositoryEloquent
     */
    private $incomeService;
    /**
     * @var Dispatcher
     */
    private $dispatcher;
    /**
     * @var IncomeServiceFundStructure
     */
    private $structuralFund;

    /**
     * Create the command handler.
     *
     * @param IncomeServiceRepositoryEloquent $incomeService
     * @param Dispatcher $dispatcher
     * @param IncomeServiceFundStructure $structuralFund
     */
    public function __construct(
        IncomeServiceRepositoryEloquent $incomeService,
        Dispatcher $dispatcher,
        IncomeServiceFundStructure $structuralFund
    )
    {
        $this->incomeService = $incomeService;
        $this->dispatcher = $dispatcher;
        $this->structuralFund = $structuralFund;
    }

    /**
     * Handle the command.
     *
     * @param CreateIncomeServiceCommand $command
     * @return void
     */
    public function handle(CreateIncomeServiceCommand $command)
    {
        $input = [
            'service_id' => $command->serviceId,
            'service_date' => $command->serviceDate,
            'created_by' => $command->userId,
            'role_access' => $command->roleAccess,
            'status' => $command->status
        ];

        $incomeService = $this->incomeService->save($input);
        $this->dispatcher->fire(new IncomeServiceWasCreated($incomeService->id));

        return $incomeService;
    }
}
