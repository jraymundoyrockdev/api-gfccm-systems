<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\IncomeServiceDenomination;
use ApiGfccm\Models\IncomeServiceFundItemStructure;
use ApiGfccm\Models\IncomeServiceFundStructure;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

class IncomeServiceRepositoryEloquent implements RepositoryInterface, IncomeServiceRepositoryInterface
{
    /**
     * @var IncomeService
     */
    protected $incomeService;

    /**
     * @var IncomeServiceFundStructure
     */
    protected $fundStructure;

    /**
     * @var IncomeServiceDenomination
     */
    protected $denominationStructure;

    /**
     * @var IncomeServiceFundItemStructure
     */
    protected $fundItemStructure;

    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @param IncomeService $incomeService
     * @param Guard $guard
     * @param IncomeServiceFundStructure $fundStructure
     * @param IncomeServiceFundItemStructure $fundItemStructure
     * @param IncomeServiceDenomination $denominationStructure
     */
    public function __construct(
        IncomeService $incomeService,
        Guard $guard,
        IncomeServiceFundStructure $fundStructure,
        IncomeServiceFundItemStructure $fundItemStructure,
        IncomeServiceDenomination $denominationStructure
    )
    {
        $this->incomeService = $incomeService;
        $this->fundStructure = $fundStructure;
        $this->fundItemStructure = $fundItemStructure;
        $this->denominationStructure = $denominationStructure;
        $this->guard = $guard;
    }

    /**
     * Returns all Income Services
     *
     * @return IncomeService
     */
    public function all()
    {
        return $this->incomeService->all();
    }

    /**
     * Returns an Income Service
     *
     * @param int $id
     * @return IncomeService|null
     */
    public function findById($id)
    {
        return $this->incomeService->find($id);
    }

    /**
     * @param array $payload
     * @return IncomeService
     */
    public function create(array $payload)
    {
        return $this->incomeService->create($payload);
    }

    /**
     * @param array $payload
     * @param int $id
     * @return IncomeService|null
     */
    public function update(array $payload, $id)
    {
        $incomeService = $this->incomeService->find($id);

        if (!$incomeService) {
            return null;
        }

        $incomeService->fill($payload)->save();

        return $incomeService;
    }

    /**
     * Updates funds amount
     *
     * @param int $id
     * @param array $payload
     * @param string $method
     * @return mixed
     */
    public function updateFunds($id, $payload, $method = 'addition')
    {
        $incomeService = $this->incomeService->find($id);

        if ($method == 'addition') {
            foreach ($payload as $field => $value) {
                $incomeService->$field += $value;
            }
        }

        if ($method == 'subtraction') {
            foreach ($payload as $field => $value) {
                $incomeService->$field -= $value;
            }
        }

        return $incomeService->save();
    }

    /**
     * Update Denomination
     *
     * @param array $payload
     * @return array
     */
    public function updateDenomination($payload)
    {
        foreach ($payload as $denomination) {
            $this->denominationStructure->find($denomination['id'])->fill([
                'piece' => $denomination['piece'],
                'total' => $denomination['total']
            ])->save();
        }

        return $payload;
    }

    /**
     * Compute totals of all Income Services
     *
     * @param int $year
     * @param null $month
     * @return mixed
     */
    public function getTotal($year, $month = null)
    {
        $queryBuild = DB::table('income_services')
            ->select(DB::raw(
                'DATE_FORMAT(service_date, "%m") AS month,
                DATE_FORMAT(service_date, "%Y") AS year,
                SUM(tithes) as tithes ,
                SUM(offering) as offering,
                SUM(other_fund) as other_fund,
                SUM(total) as total'))
            ->whereYear('service_date', '=', $year);

        if ($month) {
            $queryBuild = $queryBuild->whereMonth('service_date', '=', $month);
        }

        return $queryBuild->groupBy(DB::raw('DATE_FORMAT(service_date, "%m")'))
            ->orderBy(DB::raw('DATE_FORMAT(service_date, "%m")'), 'ASC')
            ->get();
    }

    /**
     * Get all Services by month and year
     *
     * @param int $year
     * @param int $month
     * @return IncomeService
     */
    public function findByYearAndMonth($year = null, $month = null)
    {
        $year = $year ?: date('Y');
        $month = $month ?: date('m');

        return $this->incomeService
            ->whereYear('service_date', '=', $year)
            ->whereMonth('service_date', '=', $month)
            ->orderBy('service_date')
            ->get();
    }

    /**
     * Create a bulk of Structural Fund
     *
     * @param array $payload
     * @return bool
     */
    public function createFundStructure(array $payload)
    {
        return $this->fundStructure->insert($payload);
    }

    /**;
     * Create a bulk of Structural Fund Item
     * @param array $payload
     * @return bool
     */
    public function createFundItemStructure(array $payload)
    {
        return $this->fundItemStructure->insert($payload);
    }

    /**
     * Create a bulk of Denomination Structural Fund
     *
     * @param array $payload
     * @return bool
     */
    public function createDenominationStructure(array $payload)
    {
        return $this->denominationStructure->insert($payload);
    }

}
