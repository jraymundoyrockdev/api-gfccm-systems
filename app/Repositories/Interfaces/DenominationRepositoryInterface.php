<?php namespace ApiGfccm\Repositories\Interfaces;

interface DenominationRepositoryInterface
{
    /**
     * Returns all active and ordered by amount
     * 
     * @return mixed
     */
    public function allActiveOrderByAmount();
}
