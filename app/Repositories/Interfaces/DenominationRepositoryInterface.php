<?php namespace ApiGfccm\Repositories\Interfaces;

interface DenominationRepositoryInterface
{
    /**
     * Returns all and ordered by amount
     * 
     * @return mixed
     */
    public function allOrderByAmount();
}
