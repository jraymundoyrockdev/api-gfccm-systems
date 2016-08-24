<?php namespace ApiGfccm\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Find by Username
     *
     * @param string $userName
     */
    public function findByUsername($userName);

}
