<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Fund;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;

class FundRepositoryEloquent implements FundRepositoryInterface
{
    /**
     * @var Fund
     */
    protected $fund;

    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @param Guard $auth
     * @param Fund $fund
     */
    public function __construct(Guard $auth, Fund $fund)
    {
        $this->fund = $fund;
        $this->auth = $auth;
    }

    /**
     * Returns all Funds
     *
     * @return User|null
     */
    public function all()
    {
        return $this->fund->with('item')->get();
    }

    /**
     * Get a certain user
     *
     * @return User|null
     */
    public function show($id)
    {
        return $this->user->with(['member', 'user_role','item'])->where('id', $id)->first();

    }
}
