<?php namespace ApiGfccm\Repositories\Interfaces;

interface MinistryRepositoryInterface
{
    /**
     * @param $value
     * @param $key
     * @return mixed
     */
    public function getAllAsList($value, $key);

}
