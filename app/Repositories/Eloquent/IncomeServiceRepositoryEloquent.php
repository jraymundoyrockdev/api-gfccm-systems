<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\IncomeServiceDenomination;
use ApiGfccm\Models\IncomeServiceFundItemStructure;
use ApiGfccm\Models\IncomeServiceFundStructure;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

class IncomeServiceRepositoryEloquent implements IncomeServiceRepositoryInterface
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
     * Extra validation layer
     *
     * @param array $with
     * @return mixed
     */
    protected function make(array $with = [])
    {
        $income = $this->incomeService->with($with);
        return $income->whereIn('role_access', $this->grantedRoles());
    }

    /**
     * Returns all Income Services
     *
     * @return IncomeService
     */
    public function all()
    {
        return $this->make()->get();
    }

    /**
     * Returns an Income Service
     *
     * @param int $id
     * @return IncomeService
     */
    public function show($id)
    {
        return $this->make()->where('id', $id)->first();
    }

    /**
     * Create|Update Income Service
     *
     * @param array $payload
     * @param int|null $id
     * @return IncomeService
     */
    public function save($payload, $id = null)
    {
        if ($id) {
            $incomeService = $this->show($id);
            $incomeService->fill($payload)->save();
            return $incomeService;
        }
        return $this->incomeService->create($payload);
    }

    /**
     * Create a bulk of Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createFundStructure(array $payload)
    {
        return $this->fundStructure->insert($payload);
    }

    /**
     * Create a bulk of Structural Fund Item
     * @param array $payload
     * @return mixed
     */
    public function createFundItemStructure(array $payload)
    {
        return $this->fundItemStructure->insert($payload);
    }

    /**
     * Create a bulk of Denomination Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createDenominationStructure(array $payload)
    {
        return $this->denominationStructure->insert($payload);
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
        return DB::table('income_services')
            ->select(DB::raw(
                'DATE_FORMAT(service_date, "%m") AS month,
                DATE_FORMAT(service_date, "%Y") AS year,
                SUM(tithes) as tithes ,
                SUM(offering) as offering,
                SUM(other_fund) as other_fund,
                SUM(total) as total'))
            ->whereYear('service_date', '=', $year)
            ->groupBy(DB::raw('DATE_FORMAT(service_date, "%m")'))
            ->orderBy(DB::raw('DATE_FORMAT(service_date, "%m")'), 'ASC')
            ->get();
    }

    /**
     * Get all roles of the current user
     * @return array
     */
    private function grantedRoles()
    {
        $userRoles = $this->guard->user()->user_role->toArray();

        return array_map(function ($roles) {
            return $roles['role_id'];
        }, $userRoles);
    }
}