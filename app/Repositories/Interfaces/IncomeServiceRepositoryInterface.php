<?php namespace ApiGfccm\Repositories\Interfaces;

interface IncomeServiceRepositoryInterface
{
    /**
     * Returns all Income Services
     *
     * @return mixed
     */
    public function all();

    /**
     * Returns an Income Services
     *
     * @param int $id
     * @return mixed
     */
    public function show($id);

    /**
     * Create|Update Income Service
     *
     * @param array $payload
     * @param int|null $id
     * @return mixed
     */
    public function save($payload, $id = null);

}
