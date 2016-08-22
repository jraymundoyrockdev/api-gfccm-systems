<?php namespace ApiGfccm\Repositories\Interfaces;

interface ServiceRepositoryInterface
{
    /**
     * Return service as list
     *
     * @param string $value
     * @param string $key
     * @return mixed
     */
    public function getAllAsList($value, $key);
}
