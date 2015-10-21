<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;

class IncomeServiceRepositoryEloquent implements IncomeServiceRepositoryInterface
{
    /**
     * @var IncomeService
     */
    protected $incomeService;

    /**
     * @var Guard
     */
    private $guard;

    /**
     * @param IncomeService $incomeService
     * @param Guard $guard
     */
    public function __construct(IncomeService $incomeService, Guard $guard)
    {
        $this->incomeService = $incomeService;
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
