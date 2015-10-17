<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\Fund;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;

class FundRepositoryEloquent implements FundRepositoryInterface
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
    public function show($id)
    {
        return $this->fund->with('item')->find($id);
    }

    /**
     * Create|Update Fund
     *
     * @param $payload
     * @param null $id
     * @return Fund|null|static
     */
    public function save($payload, $id = null)
    {
        if ($id) {
            $fund = $this->show($id);
            $fund->fill($payload)->save();

            return $fund;
        }

        return $this->fund->create($payload);
    }
}