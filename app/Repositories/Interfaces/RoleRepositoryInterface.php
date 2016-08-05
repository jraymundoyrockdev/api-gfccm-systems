<?php namespace ApiGfccm\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

}
