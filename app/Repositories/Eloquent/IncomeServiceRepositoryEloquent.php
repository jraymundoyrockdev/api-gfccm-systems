<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use ApiGfccm\Models\IncomeServiceStructuralFund;

class IncomeServiceRepositoryEloquent implements IncomeServiceRepositoryInterface
{
    /**
     * @var IncomeService
     */
    protected $incomeService;

    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @var IncomeServiceStructuralFund
     */
    protected $structuralFund;

    /**
     * @param IncomeService $incomeService
     * @param Guard $guard
     * @param IncomeServiceStructuralFund $structuralFund
     */
    public function __construct(
        IncomeService $incomeService,
        Guard $guard,
        IncomeServiceStructuralFund $structuralFund
    ) {
        $this->incomeService = $incomeService;
        $this->guard = $guard;
        $this->structuralFund = $structuralFund;
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
     * Get all roles of the current user
     *
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
