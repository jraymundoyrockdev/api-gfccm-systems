<?php namespace ApiGfccm\Handlers\Commands;

use ApiGfccm\Commands\UpdateIncomeServiceMemberFund;
use ApiGfccm\Events\IncomeServiceMemberFundWasUpdated;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

class UpdateIncomeServiceMemberFundHandler
{

    /**
     * @var IncomeServiceMemberFundRepositoryInterface
     */
    private $memberFund;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Create the command handler.
     *
     * @param IncomeServiceMemberFundRepositoryInterface $memberFund
     * @param Dispatcher $dispatcher
     */
    public function __construct(IncomeServiceMemberFundRepositoryInterface $memberFund, Dispatcher $dispatcher)
    {
        $this->memberFund = $memberFund;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle the command.
     *
     * @param  UpdateIncomeServiceMemberFund $command
     * @return void
     */
    public function handle(UpdateIncomeServiceMemberFund $command)
    {
        $memberFund = $this->memberFund->create($command->memberFund);

        $incomeService = $this->dispatcher->fire(new IncomeServiceMemberFundWasUpdated($command->memberFund));

        return ['memberFund' => $memberFund, 'memberFundTotal' => $incomeService[0], 'fundTotal' => $incomeService[1]];
    }

}
