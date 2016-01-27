<?php namespace ApiGfccm\Listeners;

use ApiGfccm\Events\IncomeServiceWasCreated;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;

class BuildIncomeServiceDenominationStructureData
{
    /**
     * @var IncomeServiceRepositoryInterface
     */
    private $incomeService;
    /**
     * @var DenominationRepositoryInterface
     */
    private $denomination;

    /**
     *  Create the event listener.
     *
     * @param DenominationRepositoryInterface $denomination
     * @param IncomeServiceRepositoryInterface $incomeService
     */
    public function __construct(
        DenominationRepositoryInterface $denomination,
        IncomeServiceRepositoryInterface $incomeService)
    {
        $this->incomeService = $incomeService;
        $this->denomination = $denomination;
    }

    /**
     * Handle the event.
     *
     * @param  IncomeServiceWasCreated $event
     * @return void
     */
    public function handle(IncomeServiceWasCreated $event)
    {
        $this->incomeService->createDenominationStructure(
            $this->buildStructure($event->incomeServiceId, $this->denomination->getActive()->toArray()));
    }

    /**
     * Build Structure fields
     *
     * @param $incomeServiceId
     * @param array $denominations
     * @return array
     */
    private function buildStructure($incomeServiceId, Array $denominations = [])
    {
        return array_map(function ($structure) use ($incomeServiceId) {
            return [
                'income_service_id' => $incomeServiceId,
                'denomination_id' => $structure['id'],
                'description' => $structure['description'],
                'amount' => $structure['amount'],
                'piece' => 0,
                'total' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }, $denominations);
    }
}
