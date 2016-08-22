<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Fund;
use ApiGfccm\Repositories\Interfaces\AbstractApiInterface;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;

class FundRepositoryEloquent implements AbstractApiInterface, FundRepositoryInterface
{
    /**
     * @var Fund
     */
    protected $fund;

    /**
     * @param Fund $fund
     */
    public function __construct(Fund $fund)
    {
        $this->fund = $fund;
    }

    /**
     * Returns all Funds
     *
     * @return Fund|null
     */
    public function all()
    {
        return $this->fund->with('item')->get();
    }

    /**
     * Get a certain fund
     *
     * @return Fund|null
     */
    public function findById($id)
    {
        return $this->fund->with('item')->find($id);
    }

    /**
     * @param $payload
     * @return static
     */
    public function create($payload = [])
    {
        return $this->fund->create($payload);
    }

    /**
     * @param $id
     * @param array $payload
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($id, $payload = [])
    {
        $fund = $this->fund->with('item')->find($id);

        if (!$fund) {
            return null;
        }

        $fund->fill($payload)->save();

        return $fund;
    }

    /**
     * Get all Active Fund Items
     * @return mixed
     */
    public function getActive()
    {
        return $this->fund->where('status', 'active')->get();
    }

}
