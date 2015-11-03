<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\IncomeServiceDenominationStructuralFund;
use ApiGfccm\Models\IncomeServiceStructuralFund;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;

class IncomeServiceRepositoryEloquent implements IncomeServiceRepositoryInterface
{
    /**
     * @var IncomeService
     */
    protected $incomeService;

    /**
     * @var IncomeServiceStructuralFund
     */
    protected $structuralFund;

    /**
     * @var IncomeServiceDenominationStructuralFund
     */
    protected $denominationStructuralFund;

    /**
     * @param IncomeService $incomeService
     * @param IncomeServiceStructuralFund $structuralFund
     * @param IncomeServiceDenominationStructuralFund $denominationStructuralFund
     */
    public function __construct(
        IncomeService $incomeService,
        IncomeServiceStructuralFund $structuralFund,
        IncomeServiceDenominationStructuralFund $denominationStructuralFund
    )
    {
        $this->incomeService = $incomeService;
        $this->structuralFund = $structuralFund;
        $this->denominationStructuralFund = $denominationStructuralFund;
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
    public function createStructuralFund(array $payload)
    {
        return $this->structuralFund->insert($payload);
    }

    /**
     * Create a bulk of Denomination Structural Fund
     *
     * @param array $payload
     * @return mixed
     */
    public function createDenominationStructuralFund(array $payload)
    {
        return $this->denominationStructuralFund->insert($payload);
    }

    /**
     * Get all roles of the current user
     *
     * @param Guard $guard
     * @return array
     */
    private function grantedRoles(Guard $guard)
    {
        $userRoles = $guard->user()->user_role->toArray();

        return array_map(function ($roles) {
            return $roles['role_id'];
        }, $userRoles);
    }
}