<?php namespace ApiGfccm\Repositories\Interfaces;

interface AbstractApiInterface
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
    public function create($payload = []);

    /**
     * Update certain data
     *
     * @param int $id
     * @param array $payload
     * @return mixed
     */
    public function update($id, $payload = []);

}
