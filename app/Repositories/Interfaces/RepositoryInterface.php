<?php namespace ApiGfccm\Repositories\Interfaces;

/**
 * Interface RepositoryInterface
 * @package ApiGfccm\Repositories\Interfaces
 */
interface RepositoryInterface
{
    /**
     * Returns all
     *
     * @return mixed
     */
    public function all();

    /**
     * Fetched by id
     *
     * @param int $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Insert new data
     *
     * @param array $payload
     * @return mixed
     */
    public function create(array $payload);

    /**
     * Update data
     *
     * @param array $payload
     * @param int $id
     * @return mixed
     */
    public function update(array $payload, $id);

}
