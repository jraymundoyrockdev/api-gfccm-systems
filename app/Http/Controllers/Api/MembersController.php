<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Commands\CreateMemberCommand;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\MemberRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\MemberRepositoryInterface;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * @var MemberRepositoryInterface
     */
    protected $member;

    /**
     * @param MemberRepositoryInterface $member
     */
    public function __construct(MemberRepositoryInterface $member)
    {
        $this->member = $member;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return (new CollectionResponse($this->member->getAllMembers()))->asType('Member');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MemberRequest $request
     * @return Response
     */
    public function store(MemberRequest $request)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->dispatch(
            new CreateMemberCommand($input)
        )));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
