<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Http\Responses\CollectionResponse;

class UsersController extends ApiController
{

    /**
     * @var UserRepositoryInterface
     */
    protected $user;

    /**
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get all Users
     *
     * @return CollectionResponse
     */

    public function index()
    {
        return (new CollectionResponse($this->user->getAllUsers()))->asType('User');
    }

    /**
     * Get a Single User Information
     *
     * @param $id
     * @return ItemResponse
     */

    public function show($id)
    {
        return new ItemResponse($this->user->getById($id));
    }
}