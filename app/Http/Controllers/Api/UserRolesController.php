<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Repositories\Interfaces\UserRoleRepositoryInterface;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Http\Responses\CollectionResponse;

class UserRolesController extends Controller
{

    /**
     * @var UserRoleRepositoryInterface
     */
    protected $userRoles;

    /**
     * @param UserRoleRepositoryInterface $userRoles
     */
    public function __construct(UserRoleRepositoryInterface $userRoles)
    {
        $this->userRoles = $userRoles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return (new CollectionResponse($this->userRoles->getAllRoles()))->asType('UserRole');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return new ItemResponse($this->userRoles->getById($id));
    }
}
