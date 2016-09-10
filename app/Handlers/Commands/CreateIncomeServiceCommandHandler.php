<?php namespace ApiGfccm\Handlers\Commands;

use ApiGfccm\Commands\CreateIncomeServiceCommand;
use ApiGfccm\Events\IncomeServiceWasCreated;
use ApiGfccm\Models\IncomeService;
use ApiGfccm\Repositories\Eloquent\IncomeServiceRepositoryEloquent;
use Illuminate\Contracts\Events\Dispatcher;

class CreateIncomeServiceCommandHandler
{
    const INITIAL_AMOUNTS = ['tithes' => 0,'offering' => 0, 'other_fund' => 0, 'total' => 0];
    /**
     * @var IncomeServiceRepositoryEloquent
     */
    private $incomeService;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Create the command handler.
     *
     * @param IncomeServiceRepositoryEloquent $incomeService
     * @param Dispatcher $dispatcher
     */
    public function __construct(IncomeServiceRepositoryEloquent $incomeService, Dispatcher $dispatcher)
    {
        $this->incomeService = $incomeService;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle the command.
     *
     * @param CreateIncomeServiceCommand $command
     * @return IncomeService
     */
    public function handle(CreateIncomeServiceCommand $command)
    {
        $input = [
            'service_id' => $command->serviceId,
            'service_date' => $command->serviceDate,
            'created_by' => $command->userId,
            'status' => $command->status
        ];

        $input = array_merge($input, self::INITIAL_AMOUNTS);


        $incomeService = $this->incomeService->create($input);

        $this->dispatcher->fire(new IncomeServiceWasCreated($incomeService->id));

        return $incomeService;
    }
}
