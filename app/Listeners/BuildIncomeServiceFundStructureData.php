<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceWasCreated;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;

class BuildIncomeServiceFundStructureData
{
    /**
     * @var FundRepositoryInterface
     */
    private $fund;

    /**
     * @var IncomeServiceRepositoryInterface
     */
    private $incomeService;

    /**
     *  Create the event listener.
     *
     * @param FundRepositoryInterface $fund
     * @param IncomeServiceRepositoryInterface $incomeService
     */
    public function __construct(FundRepositoryInterface $fund, IncomeServiceRepositoryInterface $incomeService)
    {
        $this->fund = $fund;
        $this->incomeService = $incomeService;
    }

    /**
     * Handle the event.
     *
     * @param  IncomeServiceWasCreated $event
     * @return void
     */
    public function handle(IncomeServiceWasCreated $event)
    {
        $this->incomeService->createFundStructure(
            $this->buildStructure($event->incomeServiceId, $this->fund->getActive()->toArray()));
    }

    /**
     * Build Structure fields
     *
     * @param $incomeServiceId
     * @param array $funds
     * @return array
     */
    private function buildStructure($incomeServiceId, Array $funds = [])
    {
        return array_map(function ($structure) use ($incomeServiceId) {
            return [
                'income_service_id' => $incomeServiceId,
                'fund_id' => $structure['id'],
                'name' => $structure['name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }, $funds);
    }
}
