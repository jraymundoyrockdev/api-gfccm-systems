<?php namespace ApiGfccm\Handlers\Commands;

use ApiGfccm\Commands\DeleteIncomeServiceMemberFundTotal;
use Illuminate\Contracts\Events\Dispatcher;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;
use ApiGfccm\Events\IncomeServiceMemberFundTotalWasDeleted;

class DeleteIncomeServiceMemberFundTotalHandler
{

    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * @var IncomeServiceMemberFundRepositoryInterface
     */
    protected $memberFund;

    /**
     * Create the command handler.
     *
     * @param IncomeServiceMemberFundRepositoryInterface $memberFund
     * @param Dispatcher $dispatcher
     */
    public function __construct(IncomeServiceMemberFundRepositoryInterface $memberFund, Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->memberFund = $memberFund;
    }

    /**
     * Handle the command.
     *
     * @param  DeleteIncomeServiceMemberFundTotal $command
     * @return void
     */
    public function handle(DeleteIncomeServiceMemberFundTotal $command)
    {
        $memberFund = $this->memberFund->getByIdAndMemberId($command->incomeServiceId, $command->memberId);

        $this->memberFund->deleteTotal($memberFund->id);

        $incomeService = $this->dispatcher->fire(new IncomeServiceMemberFundTotalWasDeleted(
            $command->incomeServiceId,
            $command->memberId,
            $memberFund->tithes,
            $memberFund->offering,
            $memberFund->others,
            $memberFund->total));

        return ['memberFundTotal' => $memberFund, 'fundTotal' => $incomeService[1]];
    }
}
