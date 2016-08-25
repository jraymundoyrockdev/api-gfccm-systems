<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return CollectionResponse|null
     */
    public function index()
    {
        return (new CollectionResponse($this->user->all()))->asType('User');
    }

    /**
     * @param int $id
     * @return ItemResponse|Response
     */
    public function show($id)
    {
        $user = $this->user->findById($id);

        if (!$user) {
            return (new Response())->setStatusCode(404);
        }

        return new ItemResponse($user);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return ItemResponse|Response
     */
    public function update(Request $request, $id)
    {
        $input = array_filter($request->request->all());

        $user = $this->user->update($input, $id);

        if (!$user) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($user));
    }
}