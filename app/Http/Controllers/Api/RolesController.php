<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Response;

class RolesController extends ApiController
{
    /**
     * @var RoleRepositoryInterface
     */
    protected $roles;

    /**
     * RolesController constructor.
     * @param RoleRepositoryInterface $roles
     */
    public function __construct(RoleRepositoryInterface $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return CollectionResponse|null
     */
    public function index()
    {
        return (new CollectionResponse($this->roles->all()))->asType('Role');
    }

    /**
     * @param int $id
     * @return ItemResponse|Response
     */
    public function show($id)
    {
        $role = $this->roles->findById($id);

        if (!$role) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($role))->asType('Role');
    }
}
