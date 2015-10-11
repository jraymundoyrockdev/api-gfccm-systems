<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Fund;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use ApiGfccm\Services\KyokaiUserRoleValidator;
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
     * @var KyokaiUserRoleValidator
     */
    protected $kyokai;

    /**
     * @param Guard $auth
     * @param Fund $fund
     * @param KyokaiUserRoleValidator $kyokai
     */
    public function __construct(Guard $auth, Fund $fund, KyokaiUserRoleValidator $kyokai)
    {
        $this->fund = $fund;
        $this->auth = $auth;
        $this->kyokai = $kyokai;
    }

    /**
     * Returns all Funds
     *
     * @return User|null
     */
    public function all()
    {
/*        $user = $this->kyokai->validate($this->auth->user());

        if (!$user) {
            return false;
        }*/

        return $this->fund->all();
    }

    /**
     * Get a certain user
     *
     * @return User|null
     */
    public function show($id)
    {
        return $this->user->with(['member', 'user_role'])->where('id', $id)->first();

    }
}
